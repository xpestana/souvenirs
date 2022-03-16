<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'gestor')) {
                $table->string('gestor')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'razon')) {
                $table->string('razon')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'nif')) {
                $table->string('nif')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'identify')) {
                $table->string('identify')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'cp')) {
                $table->string('cp')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'address')) {
                $table->string('address')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'phone')) {
                $table->dropColumn('phone');
            }
            if (!Schema::hasColumn('profiles', 'gestor')) {
                $table->dropColumn('gestor');
            }
            if (!Schema::hasColumn('profiles', 'razon')) {
                $table->dropColumn('razon');
            }
            if (!Schema::hasColumn('profiles', 'nif')) {
                $table->dropColumn('nif');
            }
            if (!Schema::hasColumn('profiles', 'identify')) {
                $table->dropColumn('identify');
            }
            if (!Schema::hasColumn('profiles', 'city')) {
                $table->dropColumn('city');
            }
            if (!Schema::hasColumn('profiles', 'cp')) {
                $table->dropColumn('cp');
            }
            if (!Schema::hasColumn('profiles', 'address')) {
                $table->dropColumn('address');
            }
        });
    }
}
