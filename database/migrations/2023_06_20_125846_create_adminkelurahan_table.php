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
        Schema::create('adminkelurahan', function (Blueprint $table) {
            $table->bigIncrements('id_admin_kelurahan');
            $table->unsignedBigInteger('id_lokasi');
            $table->string('nama_admin', 50);
            $table->string('username', 50);
            $table->string('password', 50);
            $table->string('alamat_rumah', 50);
            $table->string('no_hp', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adminkelurahan');
    }
};
