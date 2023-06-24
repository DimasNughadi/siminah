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
        Schema::create('sumbangan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_donatur');
            $table->unsignedBigInteger('id_kontainer');
            $table->date('tanggal');
            $table->double('berat');
            $table->string('photo', 50);
            $table->integer('poin_reward');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumbangan');
    }
};
