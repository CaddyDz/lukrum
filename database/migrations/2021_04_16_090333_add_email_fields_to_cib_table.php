<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailFieldsToCibTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cib', function (Blueprint $table) {
            $table->text('tp1_email_intro_original')->nullable();
            $table->text('tp1_email_intro_edited')->nullable();
            $table->text('tp1_email_body_original')->nullable();
            $table->text('tp1_email_body_edited')->nullable();
            $table->text('tp1_email_cta_original')->nullable();
            $table->text('tp1_email_cta_edited')->nullable();

            $table->text('tp2_email_intro_original')->nullable();
            $table->text('tp2_email_intro_edited')->nullable();
            $table->text('tp2_email_body_original')->nullable();
            $table->text('tp2_email_body_edited')->nullable();
            $table->text('tp2_email_cta_original')->nullable();
            $table->text('tp2_email_cta_edited')->nullable();

            $table->text('tp3_email_intro_original')->nullable();
            $table->text('tp3_email_intro_edited')->nullable();
            $table->text('tp3_email_body_original')->nullable();
            $table->text('tp3_email_body_edited')->nullable();
            $table->text('tp3_email_cta_original')->nullable();
            $table->text('tp3_email_cta_edited')->nullable();

            $table->text('tp4_email_intro_original')->nullable();
            $table->text('tp4_email_intro_edited')->nullable();
            $table->text('tp4_email_body_original')->nullable();
            $table->text('tp4_email_body_edited')->nullable();
            $table->text('tp4_email_cta_original')->nullable();
            $table->text('tp4_email_cta_edited')->nullable();

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
        Schema::table('cib', function (Blueprint $table) {
            $table->dropColumn([
                'tp1_email_intro_original',
                'tp1_email_intro_edited',
                'tp1_email_body_original',
                'tp1_email_body_edited',
                'tp1_email_cta_original',
                'tp1_email_cta_edited',

                'tp2_email_intro_original',
                'tp2_email_intro_edited',
                'tp2_email_body_original',
                'tp2_email_body_edited',
                'tp2_email_cta_original',
                'tp2_email_cta_edited',

                'tp3_email_intro_original',
                'tp3_email_intro_edited',
                'tp3_email_body_original',
                'tp3_email_body_edited',
                'tp3_email_cta_original',
                'tp3_email_cta_edited',

                'tp4_email_intro_original',
                'tp4_email_intro_edited',
                'tp4_email_body_original',
                'tp4_email_body_edited',
                'tp4_email_cta_original',
                'tp4_email_cta_edited',

            ]);
        });
    }
}
