<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contracts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('which_hired');
            $table->string('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('operator_id');
            $table->integer('customer_contracts_id')->unsigned();
            $table->timestamps();
		});

        Schema::table('contracts', function (Blueprint $table){
            $table->foreign('operator_id')->references('id')->on('operators')->onDelete('cascade');
            $table->foreign('customer_contracts_id')->references('id')->on('customer_contracts')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('contracts', function (Blueprint $table){
            $table->dropForeign('operator_id');
            $table->dropForeign('customer_contracts_id');
        });

		Schema::drop('contracts');
	}

}
