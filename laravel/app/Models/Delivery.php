<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = "delivery";
    protected $primarykey = "id";
    protected $fillable = [

        'Gid',
        'RRid',
        'dppid',
        'amount_delivered',
        'delivery_confirmation'
    ];


    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function RetailerRequests() {
        return $this ->belongsTo(rrequests::class, 'RRid');
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'dppid', 'id');
    }

    public function dpayment(){
        return $this->hasOne(dpayment::class, 'delivery_id', 'id');
    }
}
