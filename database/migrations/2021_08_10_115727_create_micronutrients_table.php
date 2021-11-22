<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicronutrientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micronutrients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('name_html')->nullable();
            $table->mediumText('description_html')->nullable();
            $table->boolean('is_vitamin')->default(false);
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
        Schema::dropIfExists('micronutrients');
    }
}
