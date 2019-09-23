<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcinfo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('caserefno');
            $table->string('mcrefno');
            $table->string('husstatus');
            $table->string('clinicrefno');
            $table->string('startdate');
            $table->string('enddate');
            $table->string('totalmc');
            $table->string('dateadd');
            $table->string('addby');
            $table->string('baoapprdate');
            $table->string('scorecommend');
            $table->timestamps();
            // $table->primary(['caserefno', 'mcrefno']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcinfo');
    }
}
