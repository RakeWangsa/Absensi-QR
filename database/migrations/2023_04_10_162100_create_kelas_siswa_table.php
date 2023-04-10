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
        Schema::create('kelasSiswa', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_siswa');
            $table->string('nama');
            $table->string('nim')->nullable();
            $table->string('kelas')->nullable();
            // $table->string('kelas1');
            // $table->string('kelas2');
            // $table->string('kelas3');
            // $table->string('kelas4');
            // $table->string('kelas5');
            // $table->string('kelas6');
            // $table->string('kelas7');
            // $table->string('kelas8');
            // $table->string('kelas9');
            // $table->string('kelas10');
            // $table->string('kelas11');
            // $table->string('kelas12');
            // $table->string('kelas13');
            // $table->string('kelas14');
            // $table->string('kelas15');
            // $table->string('kelas16');
            // $table->string('kelas17');
            // $table->string('kelas18');
            // $table->string('kelas19');
            // $table->string('kelas20');
            // $table->string('kelas21');
            // $table->string('kelas22');
            // $table->string('kelas23');
            // $table->string('kelas24');
            // $table->string('kelas25');
            // $table->string('kelas26');
            // $table->string('kelas27');
            // $table->string('kelas28');
            // $table->string('kelas29');
            // $table->string('kelas30');
            // $table->string('kelas31');
            // $table->string('kelas32');
            // $table->string('kelas33');
            // $table->string('kelas34');
            // $table->string('kelas35');
            // $table->string('kelas36');
            // $table->string('kelas37');
            // $table->string('kelas38');
            // $table->string('kelas39');
            // $table->string('kelas40');
            // $table->string('kelas41');
            // $table->string('kelas42');
            // $table->string('kelas43');
            // $table->string('kelas44');
            // $table->string('kelas45');
            // $table->string('kelas46');
            // $table->string('kelas47');
            // $table->string('kelas48');
            // $table->string('kelas49');
            // $table->string('kelas50');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelasSiswa');
    }
};
