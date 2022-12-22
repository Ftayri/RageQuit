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
        Schema::table('games', function (Blueprint $table) {
            $table->float('average_rating')->nullable();
            $table->longText('description')->nullable();
            $table->string('steam_link')->nullable();
            $table->string('website_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('average_rating');
            $table->dropColumn('description');
            $table->dropColumn('steam_link');
            $table->dropColumn('website_link');
        });
    }
};
