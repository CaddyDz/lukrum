<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectsFieldsToCustomCreativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_creative', function (Blueprint $table) {
            $table->text('ld_subhead_original')->nullable();
            $table->text('ld_subhead_edited')->nullable();

            $table->text('op_subhead_original')->nullable();
            $table->text('op_subhead_edited')->nullable();

            $table->string('op_professionals', 30)->nullable();
            $table->string('op_projects', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_creative', function (Blueprint $table) {
            $table->dropColumn(['ld_subhead_original', 'ld_subhead_edited', 'op_subhead_original', 'op_subhead_edited', 'op_professionals', 'op_projects', ]);
        });
    }
}
