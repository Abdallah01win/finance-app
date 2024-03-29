<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'userId',
        'title',
        'date',
        'description',
        'ammount',
        'type',
        'category_id'       
    ];
}
