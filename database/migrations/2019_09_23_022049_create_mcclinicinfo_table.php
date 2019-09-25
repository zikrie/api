<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcclinicinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcclinicinfo', function (Blueprint $table) {
            // $table->integer('id');
            $table->string('caserefno');
            $table->bigIncrements('clinicrefno');
            $table->string('clinicinfo');
            $table->string('addby');
            $table->string('dateadd');
            $table->timestamps();
            // $table->primary(['caserefno', 'clinicrefno']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcclinicinfo');
    }
}
