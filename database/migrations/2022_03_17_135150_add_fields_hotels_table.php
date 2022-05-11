<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'calle')) {
                $table->string('calle')->nullable();
            }
            if (!Schema::hasColumn('hotels', 'planta')) {
                $table->string('planta')->nullable();
            }
            if (!Schema::hasColumn('hotels', 'cp')) {
                $table->string('cp')->nullable();
            }
            if (!Schema::hasColumn('hotels', 'code')) {
                $table->string('code')->nullable();
            }
            if (!Schema::hasColumn('hotels', 'url')) {
                $table->string('url')->nullable();
            }
            if (!Schema::hasColumn('hotels', 'area')) {
                $table->string('area')->nullable();
            }
            $table->string('name')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'calle')) {
                $table->dropColumn('calle');
            }
            if (!Schema::hasColumn('hotels', 'planta')) {
                $table->dropColumn('planta');
            }
            if (!Schema::hasColumn('hotels', 'cp')) {
                $table->dropColumn('cp');
            }
            if (!Schema::hasColumn('hotels', 'code')) {
                $table->dropColumn('code');
            }
            if (!Schema::hasColumn('hotels', 'url')) {
                $table->dropColumn('url');
            }
            if (!Schema::hasColumn('hotels', 'area')) {
                $table->dropColumn('area');
            }
        });
    }
}
