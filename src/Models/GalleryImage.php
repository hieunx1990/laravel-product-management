<?php

namespace Hieu\ProductManagement\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['url', 'name'];
    public $timestamps = false;

    protected static function boot() {
        parent::boot();
        // delete file after delete model
        static::deleting(function($image) {
            unlink(public_path('uploads') . '/' . $image->url);
        });
    }
    /**
     * find image by id
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|Model|null
     */
    public static function findById($id) {
        return self::query()->firstWhere('id', '=', $id);
    }
}
