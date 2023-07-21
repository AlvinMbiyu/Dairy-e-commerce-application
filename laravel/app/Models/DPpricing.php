<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DPpricing extends Model
{
    use HasFactory;
    protected $table = "dppricing";
    protected $primaryKey = "id";
    protected $fillable = [
        'Did',
        'dpricing',
        'per_litre'
    ];

    public function DP(){
        return $this->belongsTo(Deliveryperson::class, 'Rid');
    }
}
