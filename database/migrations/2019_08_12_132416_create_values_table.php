<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('value');
            $table->unsignedBigInteger('discipline_id');
            $table->unsignedBigInteger('student_id');
            $table->string('class');
            $table->string('year');
            $table->unsignedInteger('age');
            $table->unsignedBigInteger('teacher_id');
            $table->DateTime('datetime');
            $table->timestamps();
            //ToDo Maybe add another column for additional comments

            $table->foreign('discipline_id')->references('id')->on('disciplines');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('teacher_id')->references('id')->on('teachers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
}
