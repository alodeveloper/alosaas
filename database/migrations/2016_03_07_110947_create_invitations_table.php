<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function($table) {
          $table->increments('id');
          $table->integer('account_id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->string('invitation_code')->unique()->index();
          $table->timestamp('invitation_sent_at');
          $table->timestamp('invitation_accepted_at');
          $table->timestamp('invitation_expire_at');
          $table->string('email')->index();

          $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('invitations');
    }
}
