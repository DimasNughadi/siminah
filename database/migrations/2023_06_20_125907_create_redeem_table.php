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
            $table->bigIncrements('id_redeem');
            $table->unsignedBigInteger('id_donatur');
            $table->unsignedBigInteger('id_reward');
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
