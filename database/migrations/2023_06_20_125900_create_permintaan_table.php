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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->bigIncrements('id_permintaan');
            $table->unsignedBigInteger('id_kontainer');
            $table->unsignedBigInteger('id_lokasi');
            $table->unsignedBigInteger('id_admin_kelurahan');
            $table->date('tanggal_permintaan');
            $table->string('status_kontainer', 50);
            $table->string('status_permintaan', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
};
