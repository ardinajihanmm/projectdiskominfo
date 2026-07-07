<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();

            $table->string('kode_ticket')->unique();
            $table->string('judul');
            $table->text('deskripsi');

            $table->enum('prioritas', [
                'Rendah',
                'Sedang',
                'Tinggi'
            ])->default('Sedang');

            $table->enum('status', [
                'To Do',
                'In Progress',
                'Completed',
                'Rejected'
            ])->default('To Do');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};