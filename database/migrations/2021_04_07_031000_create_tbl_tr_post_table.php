<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTrPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tr_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('keyword')->nullable();
            $table->text('desc')->nullable();
            $table->text('title_seo')->nullable();
            $table->text('lang_id')->nullable();
            $table->text('post_id')->nullable();
            $table->text('h1')->nullable();
            $table->text('h2')->nullable();
            $table->text('h3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tr_post');
    }
}
