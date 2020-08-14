<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Streams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('streams')) {

            Schema::create('streams', function (Blueprint $table) {
                $table->id()->unsigned();
                $table->string("name");
                $table->string("description")->nullable();
                $table->bigInteger("buildid")->unsigned();
                $table->string("category");
                $table->BigInteger("unit_id")->unsigned();
                $table->integer("quantity");
                $table->BigInteger("valuta_id")->unsigned();
                $table->integer("price")->nullable();
            });

            Schema::table('streams', function (Blueprint $table) {
                $table->foreign('buildid')
                    ->references('id')
                    ->on('building')
                    ->onDelete('cascade');
                $table->foreign('unit_id')
                    ->references('id')
                    ->on('unit')
                    ->onDelete('cascade');
                $table->foreign('valuta_id')
                    ->references('id')
                    ->on('valuta')
                    ->onDelete('cascade');
            });
        }}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streams');

    }
}
