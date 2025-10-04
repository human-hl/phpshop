<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use SoftDeletes;
    protected $fillable = ['category_id','brand_id','name','slug','description','price','stock','is_new','is_hit','is_sale','main_image'];

    public function category(){ return $this->belongsTo(Category::class); }
    public function brand(){ return $this->belongsTo(Brand::class); }
    public function images(){ return $this->hasMany(ProductImage::class); }
}
