<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomCreativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_creative', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';

            $table->id();
            $table->timestamps();
            $table->integer('form_id');

            $table->string('overlay_url', 400)->nullable();
            $table->text('overlay_json')->nullable();

            $table->string('ads_cta_original', 100)->nullable();
            $table->string('ads_cta_edited', 100)->nullable();
            $table->string('ads_headline_original', 255)->nullable();
            $table->string('ads_headline_edited', 255)->nullable();
            $table->string('ads_body_original', 1000)->nullable();
            $table->string('ads_body_edited', 1000)->nullable();

            $table->string('sm_cta_original', 100)->nullable();
            $table->string('sm_cta_edited', 100)->nullable();
            $table->string('sm_headline_original', 255)->nullable();
            $table->string('sm_headline_edited', 255)->nullable();
            $table->string('sm_body_original', 1000)->nullable();
            $table->string('sm_body_edited', 1000)->nullable();

            $table->string('ld_cta_original', 100)->nullable();
            $table->string('ld_cta_edited', 100)->nullable();
            $table->string('ld_headline_original', 255)->nullable();
            $table->string('ld_headline_edited', 255)->nullable();
            $table->text('ld_body_original')->nullable();
            $table->text('ld_body_edited')->nullable();

            $table->string('op_cta_original', 100)->nullable();
            $table->string('op_cta_edited', 100)->nullable();
            $table->string('op_headline_original', 255)->nullable();
            $table->string('op_headline_edited', 255)->nullable();
            $table->text('op_body_original')->nullable();
            $table->text('op_body_edited')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_creative');
    }
}
