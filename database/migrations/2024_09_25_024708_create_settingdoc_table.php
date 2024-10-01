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
        Schema::create('settingdoc', function (Blueprint $table) {

            $table->string('uuid',50)->primary();
            $table->string('doc_type',50)->nullable()->default('');

            $table->string('prefix1',50)->nullable()->default('');

            $table->string('doc_year',50)->nullable()->default('');
            $table->string('prefix2',50)->nullable()->default('');
            $table->string('doc_month',50)->nullable()->default('');
            $table->string('prefix3',50)->nullable()->default('');
            $table->integer('doc_digit')->nullable()->default(3);
            $table->string('previewnumber',50)->nullable()->default('');

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
        Schema::dropIfExists('settingdoc');
    }
};
