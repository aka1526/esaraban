<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {

            $table->string('uuid',50)->primary();
            $table->string('name',200)->nullable()->default('')->index();
            $table->string('type',50)->nullable();
            $table->string('stat',50)->nullable()->default('Y');
            $table->string('created_at',50)->nullable()->default('');
            $table->string('created_by',200)->nullable()->default('');
            $table->string('updated_at',50)->nullable()->default('');
            $table->string('updated_by',200)->nullable()->default('');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
};
