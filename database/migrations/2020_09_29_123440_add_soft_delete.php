<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDelete extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('streams', 'deleted_at')) {

            Schema::table('streams', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        Schema::table('streams', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
