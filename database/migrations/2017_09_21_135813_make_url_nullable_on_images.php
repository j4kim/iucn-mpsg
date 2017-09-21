<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUrlNullableOnImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('url', 80)->nullable()->change();
        });
        Schema::table('maps', function (Blueprint $table) {
            $table->string('url', 80)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->text('url')->change();
        });
        Schema::table('maps', function (Blueprint $table) {
            $table->text('url')->change();
        });
    }
}
