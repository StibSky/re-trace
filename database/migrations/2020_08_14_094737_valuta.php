<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Valuta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('valuta')) {

            Schema::create('valuta', function (Blueprint $table) {
                $table->id()->unsigned();
                $table->string("name");
                $table->string("symbol")->nullable();
                $table->dateTime("created_at")->default(date("Y-m-d H:i:s"));
                $table->dateTime("updated_at")->default(date("Y-m-d H:i:s"));
            });
        }}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
