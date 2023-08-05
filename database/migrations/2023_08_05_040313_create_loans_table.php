<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id('loan_id');
            $table->string('name', 200);
            $table->tinyInteger('type')->unsigned();
            $table->unsignedInteger('amount');
            $table->unsignedSmallInteger('duration');
            $table->unsignedInteger('installment');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
