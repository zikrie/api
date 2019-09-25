<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMciteminfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mciteminfo', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->string('caserefno');
            $table->bigIncrements('mcitemid');
            $table->string('mcrefno');
            $table->string('mcitemstartdate');
            $table->string('mcitemenddate');
            $table->string('totalmcitem');
            $table->string('approvalsts');
            $table->string('dateadd');
            $table->string('addby');
            $table->timestamps();
            // $table->primary(['caserefno', 'mcitemid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mciteminfo');
    }
}
