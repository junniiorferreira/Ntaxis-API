<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorridasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corridas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('id_usuario_request', 50);
            $table->string('id_usuario_response', 50)->nullable();
            $table->string('corrida_status', 50);            
            $table->string('corrida_distance', 50);
            $table->string('corrida_time', 50)->nullable();;
            $table->string('corrida_price', 50);
            $table->string('rest_price', 50)->nullable();;
            $table->string('price_type', 50)->nullable();;            
            $table->string('request_lat_start', 50);
            $table->string('request_long_start', 50);
            $table->string('request_lat_end', 50);
            $table->string('request_long_end', 50);
            $table->string('response_lat_real', 50)->nullable();
            $table->string('response_long_real', 50)->nullable();
            $table->string('response_distance', 50)->nullable();
            $table->string('response_time', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corridas');
    }
}
