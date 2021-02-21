<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('bid');
            $table->foreignId('uid')->references('id')->on('users');
            $table->string('topic');
            $table->text('subject_text');
            $table->unsignedInteger('amount_of_messages')->default(0);;
            $table->unsignedInteger('amount_of_documents')->default(0);;
            $table->timestamps();

            $table->foreign('bid')->references('headline')->on('boards');
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
