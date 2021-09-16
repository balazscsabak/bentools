<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function featuredImage()
    {
        return $this->hasOne(Media::class, 'id', 'featured_image');
    }

    public function categoryImage()
    {
        return $this->hasOne(Media::class, 'id', 'category_image_id');
    }

    public function images()
    {
         return $this->id;
    }

    public function getImagesModelsAttribute()
    {
        return  Media::find(explode('~', $this->images));
    }

    public function variants() 
    {
        return $this->hasMany(Variants::class, 'product_id');
    }
}
