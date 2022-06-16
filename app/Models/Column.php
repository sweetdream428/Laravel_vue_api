<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'order'
    ];

    public function cardLists()
    {
        return $this->hasMany(Card::class, 'column_id');
    }
}
