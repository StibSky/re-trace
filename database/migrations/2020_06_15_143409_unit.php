<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Unit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('unit')) {

            Schema::create('unit', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string("name");
            $table->string("name_nl")->nullable();
            $table->string("name_fr")->nullable();
            $table->string("short_name");
            $table->string("short_name_nl")->nullable();
            $table->string("short_name_fr")->nullable();
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
