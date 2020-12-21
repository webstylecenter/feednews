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
        Schema::table('user_feed_item', function (Blueprint $table) {
            $table->foreign('user_feed_id', 'FK_9F6C43AD9A8A209')->references('id')->on('user_feed')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('user_id', 'FK_9F6C43ADA76ED395')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('feed_item_id', 'FK_9F6C43ADA87D462B')->references('id')->on('feed_item')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_feed_item', function (Blueprint $table) {
            $table->dropForeign('FK_9F6C43AD9A8A209');
            $table->dropForeign('FK_9F6C43ADA76ED395');
            $table->dropForeign('FK_9F6C43ADA87D462B');
        });
    }
}
