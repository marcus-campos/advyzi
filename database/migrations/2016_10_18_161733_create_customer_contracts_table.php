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
            $table->string('phone');
            $table->string('address');
            $table->string('zipcode');
            $table->string('city');
            $table->string('nif')->unique();
            $table->enum('client_type', ['company', 'private']);
            $table->enum('client_status', ['effective', 'external']);
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::table('customer_contracts', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
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
            $table->dropForeign('customer_contracts_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('customer_contracts');
    }
}
