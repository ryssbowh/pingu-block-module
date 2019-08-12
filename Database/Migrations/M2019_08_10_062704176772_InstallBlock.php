<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class M2019_08_10_062704176772_InstallBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('class');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('system');
            $table->json('data');
            $table->integer('provider_id')->unsigned()->index();
            $table->foreign('provider_id')->references('id')->on('block_providers')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('block_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('text');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_texts');
        Schema::dropIfExists('block_creators');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('block_providers');
    }
}
