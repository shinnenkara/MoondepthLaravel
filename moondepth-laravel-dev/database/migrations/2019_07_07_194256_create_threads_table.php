<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bid');
            $table->unsignedBigInteger('uid')->default(0);
            $table->string('topic');
            $table->text('subject_text');
            $table->unsignedBigInteger('amount_of_messages')->default(1);
            $table->unsignedBigInteger('amount_of_documents')->default(0);
            $table->timestamps();

            $table->foreign('bid')->references('headline')->on('boards');
            $table->index('topic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
