<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $table = "county";
    protected $primarykey = "id";
    protected $fillable = [
        'name'];

    public function subCounty(){
        return $this->hasMany(Subcounty::class, 'county_id', 'id');
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
