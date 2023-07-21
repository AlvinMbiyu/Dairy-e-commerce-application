<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivestockType extends Model
{
    use HasFactory;
    protected $table = "livestocktype";
    protected $primarykey = "Ltid";
    protected $fillable = [

        'Type',
        'Mamount_each'
    ];

    public $timestamps = false;

    public function liv(){
        return $this->hasMany(Livestock::class, 'Ltid');
    }
}
