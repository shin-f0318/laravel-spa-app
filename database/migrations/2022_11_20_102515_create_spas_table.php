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
        Schema::create('spas', function (Blueprint $table) {
            $table->id();
            // doubleメソッドでは、指定した精度（合計桁数）とスケール（小数桁数）を指定する
            $table->double('spa_lat',9,7);
            $table->double('spa_lng',10,7);
            $table->string('spa_address');
            $table->string('spa_name');
            $table->string('spa_type');
            $table->string('spa_price');
            $table->text('spa_point');
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
        Schema::dropIfExists('spas');
    }
};
