<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UploadBukti extends Model
{
    protected $table = 'upload_bukti';
    protected $fillable = ['laporan_id', 'file_path', 'keterangan'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }
}

