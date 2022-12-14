<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'category_name',
    ];

     //created relation between categories and users table by eloquent orm
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
