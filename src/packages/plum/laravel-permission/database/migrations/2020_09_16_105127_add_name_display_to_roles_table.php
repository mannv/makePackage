<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameDisplayToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('roles', 'name_display')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->string('name_display')->after('name');
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
        if (Schema::hasColumn('roles', 'name_display')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->dropColumn(['name_display']);
            });
        }
    }
}
