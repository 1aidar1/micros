<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEfficienciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //*Коды эффективности: 5-доказанная эффективность; 4-вероятная эффективность; 3-возможная эффективность; 2-возможная неэффективность; 1-недостаточно доказательств
    public function up()
    {
        Schema::create('efficiencies', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('description');
            $table->string('color')->default("#000000");
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
        Schema::dropIfExists('efficiencies');
    }
}
