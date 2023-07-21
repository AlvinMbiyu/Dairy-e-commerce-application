<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Farmers extends Authenticatable
{
    use HasFactory;
    protected $table = "farmers";
    protected $primaryKey = "Fid";
    protected $fillable = [
        
        'Name',
        'county_id',
        'sc_id',
        'town_id',
        'password',
        'email',
        'Phone_no',
        'age',
        'Gid'
    ];

    public $timestamps = false;

    protected $hidden = [
        'password',
        'remember_token'
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

    public function fg(){
        return $this->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function MC(){
        return $this->hasMany(MilkCollection::class, 'Fid', 'Fid');
    }

    public function fpayments(){
        return $this->hasMany(fpayment::class, 'Fid', 'id');
    }

    public function liv(){
        return $this->hasMany(Livestock::class, 'Fid', 'Fid');
    }

    public function avgamount(){
        return $this->hasOne(avg_amount::class, 'Fid', 'id');
    }
}
