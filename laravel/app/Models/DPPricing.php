<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;

    protected $table = "_delivery_person_pricing";
    protected $primarykey = "_delivery__person_pricing_id";
    protected $fillable = [

        'Did',
        'Delivery_pricing',
        'Additional_litre_pricing_rate'
    ];

    public function Deliveryperson() {
        return $this ->belongsTo(Deliveryperson::class, 'Did');
    }

    
}
