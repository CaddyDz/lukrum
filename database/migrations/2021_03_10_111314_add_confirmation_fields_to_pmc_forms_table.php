<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmationFieldsToPmcFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pmc_forms', function (Blueprint $table) {
            $table->string('prepared_asset_url', 300)->nullable();
            $table->dateTime('confirmation_email_sent_at')->nullable();
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
            $table->dropColumn(['prepared_asset_url', 'confirmation_email_sent_at', ]);
            //
        });
    }
}
