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
        Schema::create('redeem', function (Blueprint $table) {
            $table->string('id_redeem', 50)->primary();
            $table->string('id_donatur', 50);
            $table->string('id_reward', 50);
            $table->date('tanggal_redeem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeem');
    }
};
