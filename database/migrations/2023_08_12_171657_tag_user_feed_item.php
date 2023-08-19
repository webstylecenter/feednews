<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_feed_items', function (Blueprint $table) {
            $table
                ->bigInteger('tag_id')
                ->after('pinned')
                ->unsigned()
                ->nullable();
        });

        Schema::table('user_feed_items', function (Blueprint $table) {
            $table
                ->foreign('tag_id', 'FK_user_feed_item_tag_id')
                ->references('id')
                ->on('tags')
                ->onUpdate('NO ACTION')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feeds', function (Blueprint $table) {
            $table->dropForeign('FK_user_feed_item_tag_id');
            $table->dropColumn('tag_id');
        });
    }
};
