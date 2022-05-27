<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldEnInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('title_en',2000)->nullable();
            $table->string('description_en',2000)->nullable();
            $table->string('summary_en',2000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('title_en')->nullable();
            $table->dropColumn('description_en')->nullable();
            $table->dropColumn('summary_en')->nullable();
        });
    }
}
