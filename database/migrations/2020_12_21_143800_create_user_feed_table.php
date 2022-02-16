<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_feeds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('feed_id')->unsigned();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->tinyInteger('auto_pin')->default(false);
            $table->timestamps();

            $table->index('user_id', 'user_id_idx');
            $table->index('feed_id', 'feed_id_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_feeds');
    }
}
