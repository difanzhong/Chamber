<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateHomePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homePage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imgURI');
            $table->string('title')->nullable();
            $table->string('text')->nullable();
            $table->string('type');
            $table->string('link');
            $table->integer('displayOrder')->default(0);
            $table->boolean('display')->default(true);
            $table->timestamps();
        });

        DB::table('homePage')->insert(array(
            "imgURI" => "default.jpg",
            "type" => "滚动",
            "link" => "http://www.google.com/",
            "display" => 1,
            "displayOrder" => 1,
            "created_at" => date('Y-m-d H:i:s')
        ));

        DB::table('homePage')->insert(array(
            "imgURI" => "default.jpg",
            "type" => "滚动",
            "link" => "http://www.google.com/",
            "display" => 1,
            "displayOrder" => 2,
            "created_at" => date('Y-m-d H:i:s')
        ));

        DB::table('homePage')->insert(array(
            "imgURI" => "default.jpg",
            "type" => "滚动",
            "link" => "http://www.google.com/",
            "display" => 1,
            "displayOrder" => 3,
            "created_at" => date('Y-m-d H:i:s')
        ));

        DB::table('homePage')->insert(array(
            "imgURI" => "default.jpg",
            "type" => "滚动",
            "link" => "http://www.google.com/",
            "display" => 1,
            "displayOrder" => 4,
            "created_at" => date('Y-m-d H:i:s')
        ));

        DB::table('homePage')->insert(array(
            "imgURI" => "default.jpg",
            "type" => "滚动",
            "link" => "http://www.google.com/",
            "display" => 1,
            "displayOrder" => 5,
            "created_at" => date('Y-m-d H:i:s')
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homePage');
    }
}
