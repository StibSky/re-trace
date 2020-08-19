<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StreamImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('stream_images')) {

            Schema::create('stream_images', function (Blueprint $table) {
                $table->id()->unsigned();
                $table->string("name");
                $table->dateTime("created_at")->default(date("Y-m-d H:i:s"));
                $table->dateTime("updated_at")->default(date("Y-m-d H:i:s"));

                $table->bigInteger('streamId')->nullable()->unsigned();
            });

            Schema::table('stream_images', function (Blueprint $table) {
                $table->foreign('streamId')
                    ->references('id')
                    ->on('streams')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream_images');
    }
}
