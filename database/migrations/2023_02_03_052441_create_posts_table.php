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
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->string('levels')->nullable()->comment('Array of levels');
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->integer('remoteable')->nullable();
            $table->tinyInteger('can_part_time')->nullable()->default('0');
            $table->double('min_salary')->nullable();
            $table->double('max_salary')->nullable();
            $table->integer('current_salary')->nullable()->default('1');
            $table->text('requirement')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('number_applicants')->nullable();
            $table->integer('status')->default('0');
            $table->tinyInteger('is_pinned')->default('0');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('posts');
    }
};
