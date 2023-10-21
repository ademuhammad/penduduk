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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabupaten_id');
            $table->unsignedBigInteger('provinsi_id');
            $table->string('nama');
            $table->string('nik', 18)->unique();
            $table->enum('jeniskelamin', ['lakilaki', 'perempuan']);
            $table->dateTime('tanggallahir');
            $table->string('alamat');

            $table->timestamps();

            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('cascade');
           $table->foreign('provinsi_id')->references('id')->on('provinsis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};