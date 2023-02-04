<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_img',
        'user_id'
    ];
}
