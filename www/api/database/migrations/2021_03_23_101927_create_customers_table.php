<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institution_id');
            $table->unsignedBigInteger('place_id')
                ->nullable();
            $table->string('description')
                ->nullable();

            $table->decimal('price_total')
                ->nullable();
            $table->decimal('price_paid')
                ->nullable();

            $table->timestamp('account_received_at')
                ->nullable();
            $table->timestamp('account_paid_at')
                ->nullable();
            $table->timestamp('end_at')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('institution_id')
                ->references('id')
                ->on('institutions');
            $table->foreign('place_id')
                ->references('id')
                ->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
