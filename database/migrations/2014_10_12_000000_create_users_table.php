<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //'name', 'firstname', 'lastname', 'amount', 'email',
            //        'language', 'avatar', 'state', 'password'
            $table->uuid('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->decimal('amount', 10,2)->default(0.00);
            $table->string('language')->nullable();
            $table->longText('avatar')->nullable();
            $table->enum('state', ['OK', 'SUSPENDED', ''])->default('OK');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
