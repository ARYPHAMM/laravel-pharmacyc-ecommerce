<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('category_id')->nullable();
            $table->enum('enable',array(0,1))->default('1');
            $table->enum('popular1',array(0,1))->default('0');
            $table->enum('popular2',array(0,1))->default('0');
            $table->enum('popular3',array(0,1))->default('0');
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
        Schema::dropIfExists('tbl_product');
    }
}
