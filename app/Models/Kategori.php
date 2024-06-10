<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    use HasFactory;
    protected $table = "kategori";
    protected $fillable = [
       'kategori',
       'jenis',
    ];
    
    public static function getKategoriAll()
    {
        return DB::table('kategori')
        ->select('kategori.id', 'kategori', DB::raw('ketKategori(jenis) as ketkategori'),'jenis')
        ->get();
    }
}
