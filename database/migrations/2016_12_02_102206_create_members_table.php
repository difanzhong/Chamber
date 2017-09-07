<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('pinyin');
            $table->string('e_name');
            $table->string('address');
            $table->string('n_name');
            $table->string('c_nationality');
            $table->string('o_nationality');
            $table->string('hobby');
            $table->string('occupation');
            $table->string('findus');
            $table->date('birthday');
            $table->string('birth_place');

            $table->string('contact');
            $table->string('mobile');
            $table->string('email');
            $table->string('wechat');
            $table->boolean('confirm')->default(false);

            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
