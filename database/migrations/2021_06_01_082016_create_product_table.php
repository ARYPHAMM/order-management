<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('price_sale')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('category_id_1')->nullable();
            $table->text('category_id_2')->nullable();
            $table->text('category_id_3')->nullable();
            $table->enum('status', [0, 1])->nullable()->default(1);
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
        Schema::dropIfExists('product');
    }
}
