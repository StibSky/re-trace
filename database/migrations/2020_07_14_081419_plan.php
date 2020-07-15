<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Plan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("buildid")->nullable()->unsigned();
            $table->string("plan");
            $table->dateTime("created_at")->nullable();
            $table->dateTime("updated_at")->nullable();
        });

        Schema::table('plan', function (Blueprint $table) {
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
        Schema::dropIfExists('plan');
    }
}
