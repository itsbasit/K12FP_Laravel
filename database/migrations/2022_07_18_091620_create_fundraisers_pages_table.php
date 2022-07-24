<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundraisersPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
        $table->id();
        $table->string('slug')->unique();
        $table->string('student_goal');
        $table->string('team');
        $table->text('content');
        $table->enum('cover_type', ['Image', 'Video']);
        $table->string('cover_url');
        $table->unsignedBigInteger('fundraiser')->nullable();
        $table->foreign('fundraiser')->references('id')->on('fundraisers')->onDelete('cascade');
        $table->unsignedBigInteger('student')->nullable();
        $table->foreign('student')->references('id')->on('students')->onDelete('cascade');
        $table->unsignedBigInteger('created_by');
        $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('fundraisers_pages');
    }
}
