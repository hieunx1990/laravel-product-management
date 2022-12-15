<?php

namespace Hieu\ProductManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected static function boot() {
        parent::boot();
        // delete gallery images after delete product
        static::deleting(function($product) {
            /** @var GalleryImage $image */
            foreach ($product->galleryImages as $image) {
                $image->delete();
            }
        });
    }

    /**
     * Get gallery image related
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleryImages() {
        return $this->hasMany(GalleryImage::class);
    }
}
