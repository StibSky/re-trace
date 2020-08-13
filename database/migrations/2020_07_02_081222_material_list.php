<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MaterialList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialList', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("substanceId")->nullable()->unsigned();
            $table->bigInteger("buildid")->nullable()->unsigned();
            $table->integer("quantity");
            $table->dateTime("created_at")->default(date("Y-m-d H:i:s"));
            $table->dateTime("updated_at")->default(date("Y-m-d H:i:s"));
        });

        Schema::table('materialList', function (Blueprint $table) {
            $table->foreign('buildid')
                ->references('id')
                ->on('building')
                ->onDelete('cascade');
            $table->foreign('substanceId')
                ->references('id')
                ->on('substance')
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
        Schema::dropIfExists('materialList');
    }
}
