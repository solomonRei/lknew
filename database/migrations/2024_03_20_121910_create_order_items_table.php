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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('link')->nullable();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('domestic_shipping_cost', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->boolean('is_photo_report')->default(false);
            $table->boolean('is_measure')->default(false);
            $table->boolean('is_lathing')->default(false);
            $table->boolean('is_bubble_wrap')->default(false);
            $table->boolean('is_comment')->default(false);
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('order_items');
    }
};
