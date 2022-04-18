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
        Schema::create('rof_items', function (Blueprint $table) {
            $table->id('rof_item_id');
            $table->string('form_ref_no'); //Foreign key
            $table->tinyInteger('item_no');
            $table->string('link');
            $table->string('category'); //Highloss, network improvement, enterprise, etc2.
            $table->string('item_ref_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rof_items');
    }
};
