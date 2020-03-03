<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('city_id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('color');
            $table->string('age');
            $table->string('img_url');
            $table->string('personality');
            $table->integer('is_host')->nullable();
            $table->timestamps();
            /*這裡原來的預設為:
             $table->bigIncrements('id');
             $table->timestamps();
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
