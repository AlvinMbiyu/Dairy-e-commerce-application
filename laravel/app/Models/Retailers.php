<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailers extends Model
{
    use HasFactory;

    protected $table = "farmers";
    protected $primaryKey = "Rid";
    protected $fillable = [
        
        'Name',
        'BName',
        'county_id',
        'sc_id',
        'town_id',
        'password',
        'email',
        'Phone_no',
        'age'
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

    public function requests(){
        return $this->hasMany(rrequests::class, 'Rid', 'Rid');
    }
}
