<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
public function up(): void
{
    Schema::create('rental_transactions', function (Blueprint $table) {
        $table->id();

        $table->string('transaction_code', 30)->unique();

        $table->foreignId('customer_id')
            ->constrained()
            ->restrictOnDelete();

        $table->foreignId('vehicle_id')
            ->constrained()
            ->restrictOnDelete();

        $table->date('rental_date');
        $table->date('return_date');
        $table->date('actual_return_date')->nullable();

        $table->decimal('price_per_day', 12, 2);
        $table->unsignedInteger('total_days');
        $table->decimal('total_price', 12, 2);

        $table->string('status')->default('berjalan');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_transactions');
    }
};
