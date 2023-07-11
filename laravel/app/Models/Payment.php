<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;

    protected $table = "_payment";
    protected $primarykey = "_payment_id";
    protected $fillable = [

        'Gid',
        'Rid',
        'Did',
        'Total_price',
        'Payment_confirmation'
    ];


    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function Retailers() {
        return $this ->belongsTo(Retailers::class, 'Rid');
    }

    public function Deliveryperson() {
        return $this ->belongsTo(Deliveryperson::class, 'Did');
    }
}
