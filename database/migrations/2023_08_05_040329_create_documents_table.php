<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id('document_id');
            $table->unsignedBigInteger('loan_id');
            $table->string('file_name', 200);
            $table->string('extension', 5);
            $table->binary('content');

            $table->timestamps();

            $table->foreign('loan_id')->references('loan_id')->on('loans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
