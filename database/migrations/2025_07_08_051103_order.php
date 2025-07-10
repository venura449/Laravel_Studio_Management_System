<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Company Customer Info
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_mobile')->nullable();
            $table->string('representer_name')->nullable();
            $table->string('representer_mobile')->nullable();

            // Designer and Printer
            $table->unsignedBigInteger('designer_id')->nullable();
            $table->unsignedBigInteger('printer_id')->nullable();

            // Services (JSON to store multiple entries)
            $table->json('services')->nullable(); // Example: [{service: x, qty: y, price: z}]

            // Items (JSON format)
            $table->json('items')->nullable(); // Example: [{item: x, model: y, qty: z, unit_price: a}]

            // Payment Details
            $table->enum('payment_method', ['cash', 'card', 'online', 'check'])->nullable();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('amount_due', 10, 2)->default(0);

            //state variable
            $table->enum('state', ['placed', 'designed', 'Ready', 'failed','canceled','paid','unpaid'])->nullable()->default('placed');

            // Remarks
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
