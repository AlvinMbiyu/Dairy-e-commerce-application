<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryperson extends Model
{
    use HasFactory;

    protected $table = "_livestock_type";
    protected $primaryKey = "Ltid";
    protected $fillable = [
        
        'Type',
        'Mamount'
    ];

    
}
