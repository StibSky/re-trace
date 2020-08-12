<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MaterialFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialFunction', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_nl")->nullable();
            $table->string("name_fr")->nullable();
            $table->unsignedBigInteger("parent")->nullable();
            $table->unsignedBigInteger("unit_id");
            $table->string('comments')->nullable();
            $table->dateTime("created_at")->default(date("Y-m-d H:i:s"));
            $table->dateTime("updated_at")->default(date("Y-m-d H:i:s"));

        });

        Schema::table('substance', function (Blueprint $table) {
            $table->foreign('parent')
                ->references('id')
                ->on('materialFunction')
                ->onDelete('cascade');

            $table->foreign('unit_id')
                ->references('id')
                ->on('unit')
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
        Schema::dropIfExists('materialFunction');

    }
}
