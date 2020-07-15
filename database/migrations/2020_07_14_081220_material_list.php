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
            $table->bigInteger("buildid")->nullable()->unsigned();
            $table->string("material");
            $table->dateTime("created_at")->nullable();
            $table->dateTime("updated_at")->nullable();
        });

        Schema::table('materialList', function (Blueprint $table) {
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
        Schema::dropIfExists('materialList');
    }
}
