<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToPmcFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pmc_forms', function (Blueprint $table) {
            $table->string('address', 300)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('company_url', 150)->nullable();
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
            $table->dropColumn(['address', 'city', 'company_url', ]);
        });
    }
}
