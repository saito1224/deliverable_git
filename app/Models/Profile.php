<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable=[
        'gender','old','comment'
        ];
      public function user()
{
     return $this->BelongsTo(User::class);
}
}
