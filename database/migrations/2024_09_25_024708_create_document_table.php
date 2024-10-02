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
        Schema::create('document', function (Blueprint $table) {

            $table->string('uuid',50)->primary();
            $table->string('runnumber',50)->nullable()->index();
            $table->string('prefix_doc',50)->nullable()->index();
            $table->integer('tra_year')->nullable()->index();
            $table->integer('tra_month')->nullable()->index();
            $table->date('tra_date')->nullable() ;
            $table->integer('max_doc')->nullable()->default(0) ;
             $table->string('doc_type',50)->nullable()->index();
            $table->string('lavel_urgent',50)->nullable()->index();
            $table->string('lavel_secret',50)->nullable()->index();
            $table->string('doc_status',50)->nullable()->default('PENDING'); //  PENDING FINISH CANCEL
            $table->string('doc_no',50)->nullable()->default('');
            $table->date('doc_date')->nullable();
            $table->string('doc_from',200)->nullable()->default('');
            $table->string('doc_to',200)->nullable()->default('');
            $table->string('doc_subject',300)->nullable()->default('');


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
        Schema::dropIfExists('document');
    }
};
