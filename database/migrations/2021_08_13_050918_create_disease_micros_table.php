<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseaseMicrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_micros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disease_id')->references('id')->on('diseases');
            $table->foreignId('micronutrient_id')->references('id')->on('micronutrients');
            $table->foreignId('efficiency_id')->references('id')->on('efficiencies');
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
        Schema::dropIfExists('disease_micros');
    }
}
