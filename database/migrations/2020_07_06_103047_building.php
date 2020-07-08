<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Building extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building', function (Blueprint $table) {
            $table->id();
            $table->string("address1");
            $table->string("address2");
            $table->string("city");
            $table->integer("postcode");
            $table->integer("quantity");
            $table->string("materialList");
            $table->integer("surface");
            $table->string("image");
            $table->string("status");
            $table->string("plan")->default('');
            $table->bigInteger('userid')->nullable()->unsigned();
        });

        Schema::table('building', function (Blueprint $table) {
            $table->foreign('userid')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building');

    }
}
