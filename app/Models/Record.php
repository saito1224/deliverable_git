<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
   protected $fillable=[
       'category_total',
       'total_time'];

   public function categories()   
{
   
    return $this->hasMany(Cateogry::class);
        
}
  public function user()
{
     return $this->belongsTo(User::class);
}
}
