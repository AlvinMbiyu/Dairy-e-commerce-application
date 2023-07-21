<?php

namespace App\Models;

use App\Models\Farmers as ModelsFarmers;
use Database\Seeders\farmers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerGroups extends Model
{
    use HasFactory;

    protected $table = "farmergroups";
    protected $primaryKey = "id";
    protected $fillable = [
        
        'county_id',
        'sc_id',
        'town_id',
        'price_per_litre'
    ];

    public $timestamps = 'false';

    public function requests(){
        return $this->hasMany(rrequests::class, 'Gid', 'id');
    }

    public function drequests(){
        return $this->hasMany(drequests::class, 'Gid', 'id');
    }

    public function farmers(){
        return $this->hasMany(ModelsFarmers::class, 'Gid', 'id');
    }

    public function fpayments(){
        return $this->hasMany(fpayment::class, 'Gid', 'id');
    }

    public function County(){
        return $this->belongsTo(County::class, 'county_id');
    }

    public function SubCounty(){
        return $this->belongsTo(Subcounty::class, 'sc_id');
    }

    public function Town(){
        return $this->belongsTo(Town::class, 'town_id');
    }
}
