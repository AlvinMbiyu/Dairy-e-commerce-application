<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dpayment extends Model
{
    use HasFactory;
    protected $table = "dpayment";
    protected $primarykey = "id";
    protected $fillable = [

        'Gid',
        'Did',
        'delivery_id',
        'total_dprice',
        'payment_confirmation'
    ];

    public $timestamps = false;

    public function DeliveryPerson() {
        return $this ->belongsTo(DeliveryPerson::class, 'Did');
    }

    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function Delivery() {
        return $this ->belongsTo(Delivery::class, 'delivery_id');
    }
}
