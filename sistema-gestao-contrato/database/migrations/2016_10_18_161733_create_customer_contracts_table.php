<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('region');
            $table->string('city');
            $table->string('nif');
            $table->string('which_hired');
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('operator_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::table('customer_contracts', function($table) {
            $table->foreign('operator_id')->references('id')->on('operators')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_contracts', function (Blueprint $table){
            $table->dropForeign('customer_contracts_operator_id_foreign');
            $table->dropColumn('operator_id');

            $table->dropForeign('customer_contracts_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('customer_contracts');
    }
}