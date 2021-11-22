<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSideEffectMicrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('side_effect_micros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('side_effect_id')->references('id')->on('side_effects');
            $table->foreignId('micronutrient_id')->references('id')->on('micronutrients');
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
        Schema::dropIfExists('side_effect_micros');
    }
}
