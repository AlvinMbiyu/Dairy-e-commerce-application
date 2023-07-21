<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkCollection extends Model
{
    use HasFactory;
    protected $table = "milk_collection";
    protected $primarykey = "id";
    protected $fillable = [

        'Gid',
        'Fid',
        'DRid',
        'amount_produced',
        'pickup_confirmation'
    ];

    public $timestamps = 'false';

    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function Farmers() {
        return $this ->belongsTo(Farmers::class, 'Fid');
    }

    public function DeliveryPersonRequests() {
        return $this ->belongsTo(drequests::class, 'DRid');
    }
}
