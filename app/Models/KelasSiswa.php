<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;
    protected $table = 'kelasSiswa';
    protected $fillable = ['id', 'id_siswa', 'nama', 'kelas'];
    // 'kelas1', 'kelas2', 'kelas3', 'kelas4', 'kelas5', 'kelas6', 'kelas7', 'kelas8', 'kelas9', 'kelas10',
    // 'kelas11', 'kelas12', 'kelas13', 'kelas14', 'kelas15', 'kelas16', 'kelas17', 'kelas18', 'kelas19', 'kelas20',
    // 'kelas21', 'kelas22', 'kelas23', 'kelas24', 'kelas25', 'kelas26', 'kelas27', 'kelas28', 'kelas29', 'kelas30',
    // 'kelas31', 'kelas32', 'kelas33', 'kelas34', 'kelas35', 'kelas36', 'kelas37', 'kelas38', 'kelas39', 'kelas40',
    // 'kelas41', 'kelas42', 'kelas43', 'kelas44', 'kelas45', 'kelas46', 'kelas47', 'kelas48', 'kelas49', 'kelas50',
    
}
