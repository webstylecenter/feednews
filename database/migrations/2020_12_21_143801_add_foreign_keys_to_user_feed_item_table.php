<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserFeedItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_feed_items', function (Blueprint $table) {
            $table->foreign('user_feed_id', 'FK_9F6C43AD9A8A209')->references('id')->on('user_feeds')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id', 'FK_9F6C43ADA76ED395')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('feed_item_id', 'FK_9F6C43ADA87D462B')->references('id')->on('feed_items')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_feed_items', function (Blueprint $table) {
            $table->dropForeign('FK_9F6C43AD9A8A209');
            $table->dropForeign('FK_9F6C43ADA76ED395');
            $table->dropForeign('FK_9F6C43ADA87D462B');
        });
    }
}
