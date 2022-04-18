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
        Schema::create('rof', function (Blueprint $table) {
            //Primary Keys
            $table->id('rof_id');
            $table->string('form_ref_no');
            
            //Columns for users involved in the form
            $table->string('requested_by');
            $table->string('approved_by')->nullable();
            $table->string('received_by')->nullable();
            
            //Columns for other details needed for the form
            $table->string('date');
            $table->string('time');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->string('project_type');
            $table->string('others');
            $table->string('order_type'); 
            $table->string('status'); 
            $table->string('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rof');
    }
};
