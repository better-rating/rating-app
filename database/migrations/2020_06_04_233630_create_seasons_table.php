<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('show_id');
            $table->string('season number');
            $table->timestamps();
        });
        Schema::table('episodes', function (Blueprint $table) {
            $table->renameColumn('season_number', 'season_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
        Schema::table('episodes', function (Blueprint $table) {
            $table->renameColumn('season_id', 'season_number');
        });
    }
}
