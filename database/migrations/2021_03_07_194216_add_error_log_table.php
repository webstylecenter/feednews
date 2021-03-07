<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddErrorLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('errors', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->integer('type');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('feed_id')->nullable()->unsigned();
            $table->text('exception');
            $table->integer('occurrences');
            $table->timestamps();
        });

        Schema::table('errors', function (Blueprint $table) {
            $table
                ->foreign('user_id', 'FK_error_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('cascade');

            $table
                ->foreign('feed_id', 'FK_error_feed_id')
                ->references('id')
                ->on('feeds')
                ->onUpdate('NO ACTION')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('errors', function (Blueprint $table) {
            $table->dropForeign('FK_error_user_id');
            $table->dropForeign('FK_error_feed_id');
        });


        Schema::dropIfExists('errors');
    }
}
