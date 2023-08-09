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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->string('color', 6);

            $table->index('user_id', 'user_id_idx');
            $table->foreign('user_id', 'FK_59C10862A76ED396')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropForeign('FK_59C10862A76ED396');
        });

        Schema::dropIfExists('tags');
    }
};
