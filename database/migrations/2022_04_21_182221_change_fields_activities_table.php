<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            if (!Schema::hasColumn('activities', 'duration')) {
                $table->string('duration')->nullable();
            }
            if (!Schema::hasColumn('activities', 'flow')) {
                $table->string('flow')->nullable();
            }
            if (!Schema::hasColumn('activities', 'coordinates')) {
                $table->string('coordinates')->nullable();
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
        Schema::table('activities', function (Blueprint $table) {
            if (Schema::hasColumn('activities', 'duration')) {
                $table->dropColumn('duration');
            }
            if (Schema::hasColumn('activities', 'flow')) {
                $table->dropColumn('flow');
            }
            if (Schema::hasColumn('activities', 'coordinates')) {
                $table->dropColumn('coordinates');
            }
        });

    }
}
