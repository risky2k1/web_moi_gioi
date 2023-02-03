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
        Schema::create('object_language', function (Blueprint $table) {
            $table->unsignedBigInteger('object_id');
            $table->foreignId('language_id')->constrained();
            $table->primary(['object_id','language_id']);
            $table->string('object_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('object_language');
    }
};
