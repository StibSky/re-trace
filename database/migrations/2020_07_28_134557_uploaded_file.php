<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UploadedFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploaded_file', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string("name");
            $table->integer("size")->nullable();
            $table->string("format");
            $table->string("type");
            $table->dateTime("created_at")->default(date("Y-m-d H:i:s"));
            $table->dateTime("updated_at")->default(date("Y-m-d H:i:s"));

            $table->bigInteger('userId')->nullable()->unsigned();
            $table->bigInteger("projectId")->nullable()->unsigned();
        });

        Schema::table('uploaded_file', function (Blueprint $table) {
            $table->foreign('projectId')
                ->references('id')
                ->on('building')
                ->onDelete('cascade');

            $table->foreign('userId')
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
        //
    }
}
