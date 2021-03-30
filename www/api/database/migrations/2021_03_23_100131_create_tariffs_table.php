<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institution_id');
            $table->string('name');
            $table->decimal('cost_visit')
                ->nullable()
                ->comment('Стоимость входа');
            $table->decimal('cost_minimum')
                ->nullable()
                ->comment('Минимальная оплата по тарифу');
            $table->decimal('cost_per_minute')
                ->nullable()
                ->comment('Оплата минуты по тарифу');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('institution_id')
                ->references('id')
                ->on('institutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
