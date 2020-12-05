<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('gender')->nullable();
            $table->integer('level')->default(1);
            $table->integer('sub_category_id');
            $table->string('job')->nullable();
            $table->string('icon');
            $table->integer('ability_min')->nullable();
            $table->integer('ability_max')->nullable();
            $table->string('effect_1')->nullable();
            $table->string('effect_2')->nullable();
            $table->string('effect_3')->nullable();
            $table->string('handed')->nullable();
            $table->integer('set_id')->nullable();
            $table->enum('status', ['active', 'in-active'])->default('active');
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
        Schema::dropIfExists('items');
    }
}
