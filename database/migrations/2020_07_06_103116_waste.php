<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Waste extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('waste')) {

            Schema::create('waste', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->string("material");
            $table->string("processor");
            $table->dateTime('date');

        });
    }}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waste');

    }
}
