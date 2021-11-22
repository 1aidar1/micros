<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugMicrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_micros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drug_id')->references('id')->on('drugs');
            $table->foreignId('micronutrient_id')->references('id')->on('micronutrients');
            $table->foreignId('power_id')->references('id')->on('powers');
            $table->text('comment');
            $table->text('comment_html')->nullable();
            $table->string('links');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_micros');
    }
}
