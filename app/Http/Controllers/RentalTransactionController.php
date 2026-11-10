<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\RentalTransaction;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RentalTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = RentalTransaction::with(['customer', 'vehicle'])
            ->latest()
            ->paginate(10);

        return view('rental-transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $vehicles = Vehicle::where('status', 'tersedia')->orderBy('name')->get();

        return view('rental-transactions.create', compact('customers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'rental_date' => ['required', 'date'],
            'return_date' => ['required', 'date', 'after_or_equal:rental_date'],
        ], $this->messages());

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        if ($vehicle->status !== 'tersedia') {
            return back()
                ->withInput()
                ->with('error', 'Kendaraan sedang disewa dan tidak dapat disewakan lagi.');
        }

        try {
            $transaction = DB::transaction(function () use ($validated, $vehicle) {
                $lockedVehicle = Vehicle::whereKey($vehicle->id)->lockForUpdate()->first();

                if ($lockedVehicle->status !== 'tersedia') {
                    throw new \RuntimeException('Kendaraan sedang disewa dan tidak dapat disewakan lagi.');
                }

                $totalDays = $this->calculateTotalDays($validated['rental_date'], $validated['return_date']);
                $totalPrice = $totalDays * (float) $lockedVehicle->price_per_day;

                $transaction = RentalTransaction::create([
                    'transaction_code' => $this->generateTransactionCode(),
                    'customer_id' => $validated['customer_id'],
                    'vehicle_id' => $lockedVehicle->id,
                    'rental_date' => $validated['rental_date'],
                    'return_date' => $validated['return_date'],
                    'price_per_day' => $lockedVehicle->price_per_day,
                    'total_days' => $totalDays,
                    'total_price' => $totalPrice,
                    'status' => 'berjalan',
                ]);

                $lockedVehicle->update(['status' => 'disewa']);

                return $transaction;
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('rental-transactions.show', $transaction)
            ->with('success', 'Transaksi rental berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RentalTransaction $rental_transaction)
    {
        $rental_transaction->load(['customer', 'vehicle']);

        return view('rental-transactions.show', ['transaction' => $rental_transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RentalTransaction $rental_transaction)
    {
        $customers = Customer::orderBy('name')->get();
        $vehicles = Vehicle::orderBy('name')->get();

        return view('rental-transactions.edit', [
            'transaction' => $rental_transaction,
            'customers' => $customers,
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RentalTransaction $rental_transaction)
    {
        if ($rental_transaction->status !== 'berjalan') {
            return back()->with('error', 'Transaksi yang sudah selesai tidak dapat diubah.');
        }

        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'rental_date' => ['required', 'date'],
            'return_date' => ['required', 'date', 'after_or_equal:rental_date'],
        ], $this->messages());

        try {
            DB::transaction(function () use ($validated, $rental_transaction) {
                $transaction = RentalTransaction::whereKey($rental_transaction->id)->lockForUpdate()->first();
                $newVehicle = Vehicle::whereKey($validated['vehicle_id'])->lockForUpdate()->first();

                if ($newVehicle->id !== $transaction->vehicle_id && $newVehicle->status !== 'tersedia') {
                    throw new \RuntimeException('Kendaraan sedang disewa dan tidak dapat disewakan lagi.');
                }

                $previousVehicleId = $transaction->vehicle_id;

                $totalDays = $this->calculateTotalDays($validated['rental_date'], $validated['return_date']);
                $totalPrice = $totalDays * (float) $newVehicle->price_per_day;

                $transaction->update([
                    'customer_id' => $validated['customer_id'],
                    'vehicle_id' => $newVehicle->id,
                    'rental_date' => $validated['rental_date'],
                    'return_date' => $validated['return_date'],
                    'price_per_day' => $newVehicle->price_per_day,
                    'total_days' => $totalDays,
                    'total_price' => $totalPrice,
                ]);

                if ($previousVehicleId !== $newVehicle->id) {
                    Vehicle::whereKey($previousVehicleId)->update(['status' => 'tersedia']);
                    $newVehicle->update(['status' => 'disewa']);
                }
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('rental-transactions.show', $rental_transaction)
            ->with('success', 'Transaksi rental berhasil diperbarui.');
    }

    /**
     * Process the vehicle return for a running transaction.
     */
    public function processReturn(RentalTransaction $rental_transaction)
    {
        try {
            DB::transaction(function () use ($rental_transaction) {
                $transaction = RentalTransaction::whereKey($rental_transaction->id)->lockForUpdate()->first();

                if ($transaction->status !== 'berjalan') {
                    throw new \RuntimeException('Transaksi ini sudah tidak berjalan.');
                }

                $transaction->update([
                    'actual_return_date' => Carbon::now()->toDateString(),
                    'status' => 'selesai',
                ]);

                Vehicle::whereKey($transaction->vehicle_id)->update(['status' => 'tersedia']);
            });
        } catch (\RuntimeException $e) {
            return back()->with('info', $e->getMessage());
        }

        return redirect()->route('rental-transactions.show', $rental_transaction)
            ->with('success', 'Pengembalian kendaraan berhasil. Transaksi selesai.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RentalTransaction $rental_transaction)
    {
        if ($rental_transaction->status === 'berjalan') {
            return back()->with('error', 'Transaksi yang sedang berjalan tidak dapat dihapus.');
        }

        $rental_transaction->delete();

        return redirect()->route('rental-transactions.index')
            ->with('success', 'Transaksi rental berhasil dihapus.');
    }

    /**
     * Calculate rental duration in days (minimum one day).
     */
    private function calculateTotalDays(string $startDate, string $endDate): int
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        return max(1, $start->diffInDays($end));
    }

    /**
     * Generate a unique transaction code.
     */
    private function generateTransactionCode(): string
    {
        do {
            $code = 'TRX-'.Carbon::now()->format('Ymd').'-'.strtoupper(Str::random(5));
        } while (RentalTransaction::where('transaction_code', $code)->exists());

        return $code;
    }

    /**
     * Custom validation messages.
     */
    private function messages(): array
    {
        return [
            'customer_id.required' => 'Pelanggan wajib dipilih.',
            'customer_id.exists' => 'Pelanggan tidak valid.',
            'vehicle_id.required' => 'Kendaraan wajib dipilih.',
            'vehicle_id.exists' => 'Kendaraan tidak valid.',
            'rental_date.required' => 'Tanggal mulai rental wajib diisi.',
            'rental_date.date' => 'Tanggal mulai rental tidak valid.',
            'return_date.required' => 'Tanggal rencana kembali wajib diisi.',
            'return_date.date' => 'Tanggal rencana kembali tidak valid.',
            'return_date.after_or_equal' => 'Tanggal kembali harus sama atau setelah tanggal rental.',
        ];
    }
}
