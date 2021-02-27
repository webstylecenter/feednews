<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryColumnToFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feeds', function (Blueprint $table) {
            $table
                ->bigInteger('category_id')
                ->after('url')
                ->unsigned()
                ->nullable();
        });

        Schema::table('feeds', function (Blueprint $table) {
            $table
                ->foreign('category_id', 'FK_feed_category_id')
                ->references('id')
                ->on('feed_categories')
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
            $table->dropForeign('FK_feed_category_id');
            $table->dropColumn('category_id');
        });
    }
}
