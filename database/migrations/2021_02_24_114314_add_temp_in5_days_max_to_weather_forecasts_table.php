<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTempIn5DaysMaxToWeatherForecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weather_forecasts', function (Blueprint $table) {
            $table->float('temp_in_5_days_max')->after('temp_in_4_days_min');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weather_forecasts', function (Blueprint $table) {
            $table->dropColumn('temp_in_5_days_max');
        });
    }
}
