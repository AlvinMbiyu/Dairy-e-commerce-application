<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    protected $table = "towns";
    protected $primarykey = "id";
    protected $fillable = ['name', 'lat_long', 'sc_id'];

    public function subCounty(){
        return $this->belongsTo(Subcounty::class, 'sc_id', 'id');
    }

    
    public function Farmers(){
        return $this->hasMany(Farmers::class, 'county_id', 'id');
    }

    public function Retailer(){
        return $this->hasMany(Retailers::class, 'county_id', 'id');
    }

    public function Deliverypersons(){
        return $this->hasMany(Deliveryperson::class, 'county_id', 'id');
    }
}
