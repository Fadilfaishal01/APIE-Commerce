<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'barang';
    
    protected $fillable = [
        'nama', 'harga', 'img', 'deskripsi'
    ];
}
