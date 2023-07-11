<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;

    protected $table = "_milk_collection";
    protected $primarykey = "_milk_collection_id";
    protected $fillable = [

        'Gid',
        'Fid',
        'DRid',
        'Amount_produced',
        'Pickup_confirmation'
    ];


    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function Farmers() {
        return $this ->belongsTo(Farmers::class, 'Fid');
    }

    public function DeliveryPersonRequests() {
        return $this ->belongsTo(DeliveryPersonRequests::class, 'DRid');
    }
}
