<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_t_nilai', function (Blueprint $table) {
            $table->id('id_tn');
            $table->unsignedBigInteger('id_tu');
            $table->foreign('id_tu')->references('id_tu')->on('tb_t_tugas');
            $table->integer('nilai_tn');
            $table->string('description_tn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_nilai');
    }
};
