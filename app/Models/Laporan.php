<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Laporan extends Model
{
    protected $table = 'laporan';
    protected $fillable = ['judul', 'deskripsi', 'tanggal', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bukti()
    {
        return $this->hasMany(UploadBukti::class, 'laporan_id');
    }
}
