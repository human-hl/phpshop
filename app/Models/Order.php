<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    use SoftDeletes;
    protected $fillable = ['user_id','status','total','shipping_address'];
    protected $casts = ['shipping_address' => 'array'];

    public function items(){ return $this->hasMany(OrderItem::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
