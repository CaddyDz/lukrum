<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCibTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cib', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';

            $table->id();
            $table->timestamps();

            $table->integer('form_id');
            $table->string('focus', 30)->nullable();

            $table->string('profile_url', 400)->nullable();
            $table->text('profile_json')->nullable();

            $table->string('tp1_ads_headline_original', 150)->nullable();
            $table->string('tp1_ads_headline_edited', 150)->nullable();
            $table->string('tp1_ads_cta_original', 100)->nullable();
            $table->string('tp1_ads_cta_edited', 100)->nullable();

            $table->string('tp1_sm_headline_original', 150)->nullable();
            $table->string('tp1_sm_headline_edited', 150)->nullable();
            $table->string('tp1_sm_cta_original', 100)->nullable();
            $table->string('tp1_sm_cta_edited', 100)->nullable();

            $table->string('tp2_ads_headline_original', 150)->nullable();
            $table->string('tp2_ads_headline_edited', 150)->nullable();
            $table->string('tp2_ads_cta_original', 100)->nullable();
            $table->string('tp2_ads_cta_edited', 100)->nullable();

            $table->string('tp2_sm_headline_original', 150)->nullable();
            $table->string('tp2_sm_headline_edited', 150)->nullable();
            $table->string('tp2_sm_cta_original', 100)->nullable();
            $table->string('tp2_sm_cta_edited', 100)->nullable();

            $table->string('tp3_ads_headline_original', 150)->nullable();
            $table->string('tp3_ads_headline_edited', 150)->nullable();
            $table->string('tp3_ads_cta_original', 100)->nullable();
            $table->string('tp3_ads_cta_edited', 100)->nullable();

            $table->string('tp3_sm_headline_original', 150)->nullable();
            $table->string('tp3_sm_headline_edited', 150)->nullable();
            $table->string('tp3_sm_cta_original', 100)->nullable();
            $table->string('tp3_sm_cta_edited', 100)->nullable();

            $table->string('tp4_ads_headline_original', 150)->nullable();
            $table->string('tp4_ads_headline_edited', 150)->nullable();
            $table->string('tp4_ads_cta_original', 100)->nullable();
            $table->string('tp4_ads_cta_edited', 100)->nullable();

            $table->string('tp4_sm_headline_original', 150)->nullable();
            $table->string('tp4_sm_headline_edited', 150)->nullable();
            $table->string('tp4_sm_cta_original', 100)->nullable();
            $table->string('tp4_sm_cta_edited', 100)->nullable();


            $table->string('tp2_ld_headline_original', 150)->nullable();
            $table->string('tp2_ld_headline_edited', 150)->nullable();
            $table->string('tp2_ld_intro_original', 150)->nullable();
            $table->string('tp2_ld_intro_edited', 150)->nullable();
            $table->text('tp2_ld_body_original')->nullable();
            $table->text('tp2_ld_body_edited')->nullable();
            $table->string('tp2_ld_cta_original', 100)->nullable();
            $table->string('tp2_ld_cta_edited', 100)->nullable();

            $table->string('tp3_ld_headline_original', 150)->nullable();
            $table->string('tp3_ld_headline_edited', 150)->nullable();
            $table->string('tp3_ld_intro_original', 150)->nullable();
            $table->string('tp3_ld_intro_edited', 150)->nullable();
            $table->text('tp3_ld_body_original')->nullable();
            $table->text('tp3_ld_body_edited')->nullable();
            $table->string('tp3_ld_cta_original', 100)->nullable();
            $table->string('tp3_ld_cta_edited', 100)->nullable();

            $table->string('tp4_ld_headline_original', 150)->nullable();
            $table->string('tp4_ld_headline_edited', 150)->nullable();
            $table->string('tp4_ld_intro_original', 150)->nullable();
            $table->string('tp4_ld_intro_edited', 150)->nullable();
            $table->text('tp4_ld_body_original')->nullable();
            $table->text('tp4_ld_body_edited')->nullable();
            $table->string('tp4_ld_cta_original', 100)->nullable();
            $table->string('tp4_ld_cta_edited', 100)->nullable();

            $table->text("question1")->nullable();
            $table->text("answer1")->nullable();
            $table->text("question2")->nullable();
            $table->text("answer2")->nullable();
            $table->text("question3")->nullable();
            $table->text("answer3")->nullable();
            $table->text("question4")->nullable();
            $table->text("answer4")->nullable();
            $table->text("question5")->nullable();
            $table->text("answer5")->nullable();
            $table->text("question6")->nullable();
            $table->text("answer6")->nullable();
            $table->text("question7")->nullable();
            $table->text("answer7")->nullable();
            $table->text("question8")->nullable();
            $table->text("answer8")->nullable();
            $table->text("question9")->nullable();
            $table->text("answer9")->nullable();
            $table->text("question10")->nullable();
            $table->text("answer10")->nullable();
            $table->text("question11")->nullable();
            $table->text("answer11")->nullable();
            $table->text("question12")->nullable();
            $table->text("answer12")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cib');
    }
}
