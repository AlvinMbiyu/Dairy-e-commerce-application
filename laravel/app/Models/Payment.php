<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primarykey = "id";
    protected $fillable = [

        'Gid',
        'Rid',
        'delivery_id',
        'total_price',
        'payment_confirmation'
    ];


    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function Retailers() {
        return $this ->belongsTo(Retailers::class, 'Rid');
    }

    public function Delivery() {
        return $this ->belongsTo(Delivery::class, 'Did');
    }

    public function Fpayment() {
        return $this ->hasMany(fpayment::class, 'pid', 'id');
    }
}
