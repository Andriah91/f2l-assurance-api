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
        Schema::create('publicities', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('link')->nullable();
            $table->string('path');
            $table->string('type');
            $table->boolean('is_active'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }
        //link tsy maintsy url obligatoire
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
