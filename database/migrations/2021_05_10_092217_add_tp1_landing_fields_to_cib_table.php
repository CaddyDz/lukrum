<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTp1LandingFieldsToCibTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cib', function (Blueprint $table) {

            $table->string('tp1_ld_headline_original', 150)->nullable()->after('tp4_sm_cta_edited');
            $table->string('tp1_ld_headline_edited', 150)->nullable()->after('tp1_ld_headline_original');
            $table->string('tp1_ld_intro_original', 150)->nullable()->after('tp1_ld_headline_edited');
            $table->string('tp1_ld_intro_edited', 150)->nullable()->after('tp1_ld_intro_original');
            $table->text('tp1_ld_body_original')->nullable()->after('tp1_ld_intro_edited');
            $table->text('tp1_ld_body_edited')->nullable()->after('tp1_ld_body_original');
            $table->string('tp1_ld_cta_original', 100)->nullable()->after('tp1_ld_body_edited');
            $table->string('tp1_ld_cta_edited', 100)->nullable()->after('tp1_ld_cta_original');

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
                'tp1_ld_headline_original', 'tp1_ld_headline_edited',
                'tp1_ld_intro_original', 'tp1_ld_intro_edited',
                'tp1_ld_body_original', 'tp1_ld_body_edited',
                'tp1_ld_cta_original', 'tp1_ld_cta_edited',
            ]);
        });
    }
}
