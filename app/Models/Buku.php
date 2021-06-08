<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Buku extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $timestamps = true;
    protected $primaryKey = 'id'; // or null
    protected $keyType = 'string';
    protected $fillable = ["kategori_id","judul","pengarang","penerbit","tahun_terbit","sampul","sinopsis"];
    protected $table = 'buku';
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }
    public function getKeyType()
    {
        return 'string';
    }
    public function categories(){
        return $this->belongsTo(Kategori::class,'kategori_id','id');
    }
}
