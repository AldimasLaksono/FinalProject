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
        Schema::create('tb_t_tugas', function (Blueprint $table) {
            $table->id('id_tu');
            $table->unsignedBigInteger('id_mus');
            $table->foreign('id_mus')->references('id_mus')->on('users');
            $table->unsignedBigInteger('id_mt');
            $table->foreign('id_mt')->references('id_mt')->on('tb_m_tugas');
            $table->string('desk_tj')->nullable();
            $table->string('gmb_tj')->nullable();
            $table->string('file_tj')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_tugas');
    }
};
