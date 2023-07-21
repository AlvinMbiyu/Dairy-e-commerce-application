<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;

    protected $table = "_delivery_payment";
    protected $primarykey = "_delivery_payment_id";
    protected $fillable = [

        'Did',
        'Gid',
        'DRid',
        'Amount_produced',
        'Pickup_confirmation'
    ];

    public function DeliveryPerson() {
        return $this ->belongsTo(DeliveryPerson::class, 'Did');
    }

    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function Delivery() {
        return $this ->belongsTo(Delivery::class, 'DRid');
    }
}
