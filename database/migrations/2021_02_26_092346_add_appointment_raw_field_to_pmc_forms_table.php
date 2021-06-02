<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppointmentRawFieldToPmcFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pmc_forms', function (Blueprint $table) {
            $table->text('appointment_raw')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pmc_forms', function (Blueprint $table) {
            $table->dropColumn('appointment_raw');
            //
        });
    }
}
