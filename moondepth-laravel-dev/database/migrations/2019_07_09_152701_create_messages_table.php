<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tid');
            $table->unsignedBigInteger('uid')->default(0);
            $table->unsignedBigInteger('response_to')->default(null);
            $table->text('text');
            $table->unsignedBigInteger('amount_of_documents')->default(0);
            $table->timestamps();

            $table->foreign('tid')->references('id')->on('threads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
