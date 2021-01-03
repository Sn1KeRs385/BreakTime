<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_user', function (Blueprint $table) {
            $table->unsignedBigInteger('institution_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_invite_accept')
                ->default(false);
            $table->boolean('is_admin')
                ->default(false);
            $table->boolean('is_can_change_info')
                ->default(false);

            $table->foreign('institution_id')
                ->references('id')
                ->on('institutions');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->primary(['institution_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institution_user');
    }
}
