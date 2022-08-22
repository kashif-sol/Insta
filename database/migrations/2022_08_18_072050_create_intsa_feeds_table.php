<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntsaFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intsa_feeds', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('layout');
            $table->string('spacing');
            $table->string('click');
            $table->string('border');
            $table->string('column');
            $table->string('load_more');
            $table->string('user_id');
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
        Schema::dropIfExists('intsa_feeds');
    }
}
