<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'slideshow';

    public function imageData()
    {
        return $this->hasOne(Media::class, 'id', 'image');

    }
}
