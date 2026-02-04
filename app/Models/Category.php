<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang; // jangan lupa import model Barang

class Category extends Model
{
    protected $fillable = ['name'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
