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
        Schema::create(
            'blocks', function (Blueprint $table) {
                $table->increments('id');
                $table->json('data');
                $table->boolean('active');
                $table->string('provider')->index();
                $table->unsignedInteger('permission_id')->nullable();
                $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('set null');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
