<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('firstname',200)->nullable();;
            $table->string('lastname',200)->nullable();;
            $table->integer('company')->nullable();;
            $table->foreign('company')->references('id')->on('companies');
            $table->string('email',100)->nullable();;
            $table->string('phone',100)->nullable();;
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
        Schema::dropIfExists('employees');
    }
}
