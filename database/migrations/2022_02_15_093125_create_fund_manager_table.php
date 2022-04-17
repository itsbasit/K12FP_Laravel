<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_manager', function (Blueprint $table) {
        $table->id();
		$table->integer('user_id');
		$table->string('position');
		$table->string('first_name');
		$table->string('last_name');
		$table->string('email');
		$table->string('orgType');
		$table->string('org_name');
		$table->string('streetAddress');
		$table->string('orgState');
		$table->string('zipCode');
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
        Schema::dropIfExists('fund_manager');
    }
}
