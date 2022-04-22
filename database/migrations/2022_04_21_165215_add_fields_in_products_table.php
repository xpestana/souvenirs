<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'short_id')) {
                $table->string('short_id')->nullable();
            }
            if (!Schema::hasColumn('products', 'summary')) {
                $table->string('summary', 900)->nullable();
            }
            $table->string('description', 500)->nullable()->change();
            
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
            if (Schema::hasColumn('products', 'short_id')) {
                $table->dropColumn('short_id');
            }
            if (Schema::hasColumn('products', 'summary')) {
                $table->dropColumn('summary');
            }
        });
    }
}
