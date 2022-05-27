<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldEnInActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('details_en',2000)->nullable();
            $table->string('price_notes_en',2000)->nullable();
            $table->json('price_en',2000)->nullable();
            $table->json('events_en',2000)->nullable();
            
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
            $table->dropColumn('details_en')->nullable();
            $table->dropColumn('price_notes_en')->nullable();
            $table->dropColumn('price_en')->nullable();
            $table->dropColumn('events_en')->nullable();
        });
    }
}
