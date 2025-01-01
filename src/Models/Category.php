<?php

namespace  Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug'
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model){
            $model->slug=$model->generateSlug($model->name);
        });
    }

    public function generateSlug($name)
    {
        $slug=Str::slug($name);
        $allslug=static::where("slug",'LIKE', "{$slug}%")->pluck("slug");

        if(!$allslug->contains($slug)){
            return $slug;
        }

        for ($i=1; $i<=1000; $i++){
            $newslug= "{$slug}-{$i}";
            if(!$allslug->contains($newslug)){
                return $newslug;
            }
        }
        return $slug;

    }
public function products(){
    return $this->hasMany(Product::class);
}

}
