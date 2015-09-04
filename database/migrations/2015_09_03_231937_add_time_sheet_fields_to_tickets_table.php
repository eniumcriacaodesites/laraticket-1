<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeSheetFieldsToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->boolean('timesheet_enabled');
            $table->float('timesheet_hours');
            $table->boolean('timesheet_billed');
            $table->boolean('timesheet_paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('timesheet_enabled');
            $table->dropColumn('timesheet_hours');
            $table->dropColumn('timesheet_billed');
        });
    }
}
