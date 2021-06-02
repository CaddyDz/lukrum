<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusFieldAndMoreToPmcFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pmc_forms', function (Blueprint $table) {
            $table->string('status', 30)->default('new');
            $table->string('navigation_level', 30)->nullable();
            $table->string('path', 10)->default('cc');
            $table->string('campaign_manager', 40)->nullable();

            $table->string('overlay_url', 400)->nullable();
            $table->text('overlay_json')->nullable();

            $table->text('description')->nullable();
            $table->text('comments')->nullable();

            $table->dateTime('launch_date_time')->nullable();

        });

        //Partner Email	            Partner Navigation Level	Path	Campaign Manager
        //crobeson@pierryinc.com   	N4MC	                    cc	    cr
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pmc_forms', function (Blueprint $table) {
            $table->dropColumn([
                'status', 'navigation_level', 'path', 'campaign_manager',
                'overlay_url', 'overlay_json',
                'description', 'comments', 'launch_date_time',
            ]);
        });
    }
}
