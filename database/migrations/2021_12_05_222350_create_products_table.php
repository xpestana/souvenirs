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
            $table->string('type')->comment('souvenir/activity');
            $table->string('title')->comment('titulo');
            $table->text('description');
            $table->float('price',8,2);
            $table->integer('stock')->nullable();
            $table->boolean('featured')->default(0);
            $table->dateTime('init', $precision = 0)->nullable();
            $table->dateTime('end', $precision = 0)->nullable();
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
        Schema::dropIfExists('products');
    }
}
