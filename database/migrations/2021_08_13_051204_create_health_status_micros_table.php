<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthStatusMicrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_status_micros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_status_id')->references('id')->on('health_statuses');
            $table->foreignId('micronutrient_id')->references('id')->on('micronutrients');
            $table->foreignId('usage_id')->references('id')->on('usages');
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
        Schema::dropIfExists('health_status_micros');
    }
}
