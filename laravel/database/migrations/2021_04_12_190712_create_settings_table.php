<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('code', 60);
            $table->string('value', 255)->nullable();
            $table->string('type', 10);
            $table->string('option', 255)->nullable();
            $table->string('group', 50)->nullable();
            $table->unsignedTinyInteger('order')->nullable()->default('0');
            $table->unsignedTinyInteger('is_required')->default('0');
            $table->unsignedTinyInteger('is_enabled')->default('1');
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
        Schema::dropIfExists('settings');
    }
}
