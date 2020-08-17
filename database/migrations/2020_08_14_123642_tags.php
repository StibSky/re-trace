<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tags')) {

            Schema::create('tags', function (Blueprint $table) {
                $table->id()->unsigned();
                $table->bigInteger("material_id")->unsigned();
                $table->BigInteger("function_id")->unsigned();
                $table->BigInteger("stream_id")->unsigned();
            });

            Schema::table('tags', function (Blueprint $table) {
                $table->foreign('material_id')
                    ->references('id')
                    ->on('substance')
                    ->onDelete('cascade');
                $table->foreign('function_id')
                    ->references('id')
                    ->on('materialFunction')
                    ->onDelete('cascade');
                $table->foreign('stream_id')
                    ->references('id')
                    ->on('streams')
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
        Schema::dropIfExists('tags');

    }
}
