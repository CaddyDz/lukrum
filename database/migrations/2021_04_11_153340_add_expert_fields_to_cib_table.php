<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpertFieldsToCibTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cib', function (Blueprint $table) {
            $table->string('expert_name', 100)->nullable();
            $table->string('expert_title', 100)->nullable();
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
            $table->dropColumn(['expert_name', 'expert_title', ]);
        });
    }
}
