<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFeedItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_feed_item', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('feed_item_id')->unsigned();
            $table->bigInteger('user_feed_id')->unsigned();
            $table->tinyInteger('viewed')->default(false);
            $table->tinyInteger('pinned')->default(false);
            $table->dateTime('opened')->nullable();
            $table->timestamps();

            $table->index('user_id', 'user_id_idx');
            $table->index('feed_item_id', 'feed_item_id_idx');
            $table->index('user_feed_id', 'user_feed_id_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_feed_item');
    }
}
