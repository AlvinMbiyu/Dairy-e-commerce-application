<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerGroups extends Model
{
    use HasFactory;

    protected $table = "farmergroups";
    protected $primaryKey = "id";//difference between Gid and id
    protected $fillable = [
        
        'members',
        'price_per_litre'
    ];

    public function rrequests(){
        return $this->hasMany(rrequests::class, 'Gid', 'id');
    }
}
