<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('product_model_id');
            $table->foreign('product_model_id')->references('id')->on('product_models');
            $table->string('description')->nullable();
            $table->string('color')->nullable();
            $table->integer('ram')->nullable();
            $table->text('content')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('image')->nullable();
            $table->string('quantity')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
