<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corretor extends Model
{

    protected $table = 'corretor';
    protected $fillable = [
        'cpf',
        'name',
        'creci',
    ];
    

    use HasFactory;
}
