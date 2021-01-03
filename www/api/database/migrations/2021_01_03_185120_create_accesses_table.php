<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('institution_id');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('access_types');
            $table->foreign('institution_id')
                ->references('id')
                ->on('institutions');

            $table->index(['type_id', 'institution_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesses');
    }
}
