<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('firstname')->nullable();
            $table->text('lastname')->nullable();
            $table->text('fullname')->nullable();
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->text('tel')->nullable();
            $table->text('content')->nullable();
            $table->text('province_id')->nullable();
            $table->text('distrist_id')->nullable();
            $table->enum('status', array(0, 1))->default(0);
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
        Schema::dropIfExists('tbl_order');
    }
}
