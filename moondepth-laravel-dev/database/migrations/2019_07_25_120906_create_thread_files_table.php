<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thread_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tid');
            $table->string('s3_path');
            $table->string('s3_full_path');
            $table->string('original_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('width');
            $table->unsignedBigInteger('height');
            $table->unsignedBigInteger('size');
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
        Schema::dropIfExists('thread_files');
    }
}
