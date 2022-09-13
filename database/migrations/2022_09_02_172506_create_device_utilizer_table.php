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
        Schema::create('device_utilizer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->references('id')->on('devices')->constrained()->cascadeOnDelete();
            $table->foreignId('utilizer_id')->references('id')->on('utilizers')->constrained()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_utilizer');
    }
};
