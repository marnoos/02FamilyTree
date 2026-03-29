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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->unsignedBigInteger('ayah_id')->nullable();
            $table->unsignedBigInteger('ibu_id')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('ayah_id')->references('id')->on('anggotas')->onDelete('set null');
            $table->foreign('ibu_id')->references('id')->on('anggotas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
