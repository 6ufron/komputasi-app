<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->integer('id_buku')->autoIncrement()->unsigned();
            $table->integer('kategori_id')->unsigned();
            $table->string('judul')->unique();
            $table->text('deskripsi');
            $table->string('penulis');
            $table->string('cover')->nullable();
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id_kategori')->on('kategori')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};