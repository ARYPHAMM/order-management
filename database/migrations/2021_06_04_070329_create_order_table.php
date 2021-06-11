<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->text('address')->nullable();
            $table->text('total_price')->nullable();
            $table->text('delivery_date')->nullable();
            $table->text('delivery_form')->nullable();
            $table->enum('status', ['success','wait', 'cancel','fail'])->nullable()->default('wait');
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
        Schema::dropIfExists('order');
    }
}
