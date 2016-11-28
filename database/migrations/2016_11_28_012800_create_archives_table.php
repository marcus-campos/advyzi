<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('archives', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('path');
            $table->string('directory');
            $table->integer('contract_id')->unsigned();
            $table->timestamps();
		});

        Schema::table('archives', function (Blueprint $table){
           $table->foreign('contract_id')->references('id')->on('contracts');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::table('archives', function (Blueprint $table){
	       $table->dropForeign('contract_id');
        });

		Schema::drop('archives');
	}

}
