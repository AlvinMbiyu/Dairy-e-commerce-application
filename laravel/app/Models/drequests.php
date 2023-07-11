<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;

    protected $table = "_delivery_person_requests";
    protected $primarykey = "_delivery_request_id";
    protected $fillable = [

        'Did',
        'Gid',
        'estimate_amount',
        'response'
    ];

    public function Deliveryperson() {
        return $this ->belongsTo(Deliveryperson::class, 'Did');
    }

    public function FarmerGroups() {
        return $this ->belongsTo(FarmerGroups::class, 'Gid');
    }
}
