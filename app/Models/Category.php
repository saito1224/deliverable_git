<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function record()
{
     return $this->BelongsTo(Record::class);
}
  public function user()
{
     return $this->belongsTo(User::class);
}
    protected $fillable = [
        'name',
        'workTime'
        ];
}
