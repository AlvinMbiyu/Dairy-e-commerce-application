<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rrequests extends Model
{
    use HasFactory;

    protected $table = "_rrequests";
    protected $primaryKey = "id";
    protected $fillable = [
        'Rid',
        'Gid',
        'demand_required',
        'response'
    ];

    public $timestamps = false;

    public function Retailer(){
        return $this->belongsTo(Retailers::class, 'Rid');
    }

    public function FarmerGroups(){
        return $this->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function delivery(){
        return $this->hasOne(Delivery::class, 'RRid', 'id');
    }
}
