<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_feeds', function (Blueprint $table) {
            $table->foreign('feed_id', 'FK_59C1086251A5BC03')->references('id')->on('feeds')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id', 'FK_59C10862A76ED395')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_feeds', function (Blueprint $table) {
            $table->dropForeign('FK_59C1086251A5BC03');
            $table->dropForeign('FK_59C10862A76ED395');
        });
    }
}
