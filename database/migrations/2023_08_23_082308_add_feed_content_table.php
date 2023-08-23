<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feed_item_contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('feed_item_id')->nullable()->unsigned();
            $table->longText('content')->nullable()->default(null);
            $table->foreign('feed_item_id', 'fk_fi_content_id')->references('id')->on('feed_items')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('feed_item_contents', function (Blueprint $table) {
            $table->dropForeign(['fk_fi_content_id']);
        });

        Schema::dropIfExists('feed_item_contents');
    }
};
