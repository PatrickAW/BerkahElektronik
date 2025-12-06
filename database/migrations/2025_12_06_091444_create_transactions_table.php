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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('invoice_no')->unique()->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);

            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('order_status')->default('processing');
            $table->string('paymment_reference')->nullable();

            $table->text('shipping_address')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('transactions');
        Schema::enableForeignKeyConstraints();
    }
};
