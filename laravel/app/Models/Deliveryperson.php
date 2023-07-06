<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryperson extends Model
{
    use HasFactory;

    protected $table = "_delivery_person";
    protected $primaryKey = "Did";
    protected $fillable = [
        
        'Name',
        'county_id',
        'sc_id',
        'town_id',
        'password',
        'email',
        'Phone_no',
        'age',
        'Op_vehicle',
        'vehicle_no'
    ];

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
