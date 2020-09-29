<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StreamAvailable extends Migration

{


    public function up()
    {
        if (!Schema::hasColumn('streams', 'isAvailable')) {

            Schema::table('streams', function (Blueprint $table) {
                $table->boolean("isAvailable")->default(1);
            });
        }
    }

    public function down()
    {
        Schema::table('streams', function (Blueprint $table) {
            $table->boolean("isAvailable")->nullable();
        });
    }
}
