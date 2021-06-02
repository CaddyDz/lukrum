<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmcFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmc_forms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('hash', 50);

            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 150)->nullable();
            $table->string('company', 100)->nullable();
            $table->string('job_title', 100)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('state', 50)->nullable();

            $table->string('logo_url', 400)->nullable();
            $table->text('logo_json')->nullable();
            $table->string('asset_color', 20)->nullable();

            $table->tinyInteger('billing_name_same')->default(0);

            $table->string('billing_name', 200)->nullable();
            $table->string('billing_email', 200)->nullable();
            $table->string('billing_country', 30)->nullable();
            $table->string('billing_state', 50)->nullable();
            $table->string('cc_last4', 10)->nullable();
            $table->string('purchase_reference', 100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pmc_forms');
    }
}
