<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rof_items_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category'); //Highloss, network improvement, enterprise, etc2.
            $table->string('type'); //A. Existing Link, B. New Link, C. Relocation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rof_items_categories');
    }
};
