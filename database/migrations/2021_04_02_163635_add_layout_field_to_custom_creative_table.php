<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLayoutFieldToCustomCreativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_creative', function (Blueprint $table) {
            $table->string('layout_code', 30)->nullable();
            $table->string('cloud', 30)->nullable();
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
            $table->dropColumn(['layout_code', 'cloud', ]);
        });
    }
}
