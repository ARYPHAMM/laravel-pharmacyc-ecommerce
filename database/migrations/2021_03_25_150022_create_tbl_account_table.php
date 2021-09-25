<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('username');
            $table->text('password');
            $table->text('email')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('birthday')->nullable();
            $table->unsignedInteger('role')->nullable();
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
        Schema::dropIfExists('tbl_account');
    }
}
