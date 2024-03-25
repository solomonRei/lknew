<?php

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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('address_id')->nullable();
            $table->string('status')->default('new');
            $table->double('total_weight')->nullable();
            $table->string('shipping_method')->nullable();
            $table->decimal('total_commission', 10, 2)->nullable();
            $table->decimal('total_paid', 10, 2)->nullable();
            $table->decimal('currency_rate', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->default(0.00);
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
        Schema::dropIfExists('orders');
    }
};
