<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = true;
    public function books(){
        return $this->hasMany(Buku::class);
    }
}
