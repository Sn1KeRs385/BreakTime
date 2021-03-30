<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id')
                ->nullable();
            $table->unsignedBigInteger('tariff_id');
            $table->string('description');

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

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('tariff_id')
                ->references('id')
                ->on('tariff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_users');
    }
}
