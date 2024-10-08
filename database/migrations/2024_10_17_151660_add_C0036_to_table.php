<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddC0036ToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secretname', function (Blueprint $table) {

            $table->string('faicon',200)->nullable()->default('fa-check-square');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secretname', function (Blueprint $table) {
             $table->dropColumn('faicon');

        });
    }
}
