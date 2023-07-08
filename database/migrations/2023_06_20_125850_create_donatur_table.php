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
        Schema::create('donatur', function (Blueprint $table) {
            $table->bigIncrements('id_donatur');
            $table->string('no_hp', 50);
            $table->string('nama_donatur', 50);
            $table->string('alamat_donatur', 50);
            $table->string('kelurahan', 50);
            $table->string('photo', 50);
            $table->string('password', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donatur');
    }
};
