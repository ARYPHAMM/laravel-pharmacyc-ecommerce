<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_website', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title')->nullable();
            $table->text('logo')->nullable();
            $table->text('email')->nullable();
            $table->text('copyright')->nullable();
            $table->text('maps')->nullable();
            $table->text('livechat')->nullable();
            $table->text('body')->nullable();
            $table->text('head')->nullable();
            $table->text('title_seo')->nullable();
            $table->text('keyword')->nullable();
            $table->text('desc')->nullable();
            $table->text('h1')->nullable();
            $table->text('h2')->nullable();
            $table->text('h3')->nullable();
            $table->unsignedInteger('lang_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_website');
    }
}
