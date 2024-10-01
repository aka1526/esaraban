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
        Schema::create('uploads', function (Blueprint $table) {

            $table->string('uuid',50)->primary();
            $table->string('ref_uuid',50)->nullable()->default('');
            $table->string('file_name',200)->nullable()->default('');
            $table->string('file_ext',50)->nullable()->default('');
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
        Schema::dropIfExists('uploads');
    }
};
