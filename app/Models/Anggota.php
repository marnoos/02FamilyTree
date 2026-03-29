<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'ayah_id',
        'ibu_id',
        'tanggal_lahir',
        'foto'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // --- ACCESSOR (Untuk Detail Tampilan) ---

    /**
     * Mendapatkan URL Foto yang valid atau default siluet
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return Storage::url($this->foto);
        }

        return $this->jenis_kelamin == 'L'
            ? asset('images/default-male.png')
            : asset('images/default-female.png');
    }

    /**
     * Mendapatkan umur anggota (Jika ada tanggal lahir)
     */
    public function getUmurAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age . ' Tahun' : '-';
    }

    // --- RELASI (Untuk Detail Silsilah) ---

    public function ayah()
    {
        return $this->belongsTo(Anggota::class, 'ayah_id');
    }

    public function ibu()
    {
        return $this->belongsTo(Anggota::class, 'ibu_id');
    }

    public function anak()
    {
        return $this->hasMany(Anggota::class, 'ayah_id')->orWhere('ibu_id', $this->id);
    }

    // --- FUNGSI PENGHAPUSAN (Logika Internal) ---

    /**
     * Fungsi ini otomatis berjalan saat data dihapus
     * Gunakan ini di Controller: $anggota->delete();
     */
    protected static function booted()
    {
        static::deleting(function ($anggota) {
            // 1. Hapus file foto dari folder storage jika ada
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }

            // 2. Putuskan hubungan anak (set orang tua jadi null agar tidak error)
            // Ini mencegah error "Constraint" di database
            Anggota::where('ayah_id', $anggota->id)->update(['ayah_id' => null]);
            Anggota::where('ibu_id', $anggota->id)->update(['ibu_id' => null]);
        });
    }
}
