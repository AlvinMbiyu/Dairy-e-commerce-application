<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Deliveryperson extends Authenticatable
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
    public $timestamps = 'false';

    protected $hidden = [
        'password',
        'remember_token'
    ];
    public function County()
    {
        return $this->belongsTo(County::class, 'county_id');
    }

    public function SubCounty()
    {
        return $this->belongsTo(Subcounty::class, 'sc_id');
    }

    public function Town()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }

    public function requests()
    {
        return $this->belongsTo(drequests::class, 'Did', 'Did');
    }
    
    public function dppricing(){
        return $this->hasOne(DPpricing::class, 'Did', 'Did');
    }
}
