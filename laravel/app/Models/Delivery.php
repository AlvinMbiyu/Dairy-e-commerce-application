<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;

    protected $table = "_delivery";
    protected $primarykey = "_delivery_id";
    protected $fillable = [

        'Gid',
        'RRid',
        'DPPid',
        'Amount_delivered',
        'Delivery_confirmation'
    ];


    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function RetailerRequests() {
        return $this ->belongsTo(RetailerRequests::class, 'RRid');
    }

    public function DeliveryPersonPayment() {
        return $this ->belongsTo(DeliveryPersonPayment::class, 'DPPid');
    }
}
