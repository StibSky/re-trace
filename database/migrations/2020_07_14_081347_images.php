<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Images extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("buildid")->nullable()->unsigned();
            $table->string("image");
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
        });

        Schema::table('image', function (Blueprint $table) {
            $table->foreign('buildid')
                ->references('id')
                ->on('building')
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
        Schema::dropIfExists('image');
    }
}
