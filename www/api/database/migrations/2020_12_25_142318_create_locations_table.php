<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->string('prefix');
            $table->string('name');
            $table->string('kladr_id');
            $table->string('fias_id')
                ->nullable();
            $table->bigInteger('parent_id')
                ->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('locations');
            $table->foreign('type_id')
                ->references('id')
                ->on('location_types');
            $table->index(['kladr_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
