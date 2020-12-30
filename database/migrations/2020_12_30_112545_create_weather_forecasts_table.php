<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherForecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();
            $table->string('location')->unique();
            $table->float('current_temp');
            $table->string('current_weather');
            $table->float('temp_today_max');
            $table->float('temp_today_min');
            $table->float('temp_in_1_days_max');
            $table->float('temp_in_1_days_min');
            $table->float('temp_in_2_days_max');
            $table->float('temp_in_2_days_min');
            $table->float('temp_in_3_days_max');
            $table->float('temp_in_3_days_min');
            $table->float('temp_in_4_days_max');
            $table->float('temp_in_4_days_min');
            $table->float('temp_in_5_days_min');
            $table->string('weather_in_1_days');
            $table->string('weather_in_2_days');
            $table->string('weather_in_3_days');
            $table->string('weather_in_4_days');
            $table->string('weather_in_5_days');
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
        Schema::dropIfExists('weather_forecasts');
    }
}
