<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;
    protected $table = "_drequests";
    protected $primaryKey = "id";
    protected $fillable = [
        'Did',
        'Gid',
        'est_amount',
        'response'
    ];

    public function DP(){
        return $this->belongsTo(Deliveryperson::class, 'Did');
    }

    public function FarmerGroups(){
        return $this->belongsTo(FarmerGroups::class, 'Gid');
    }

    public function MC(){
        return $this->hasOne(MilkCollection::class, 'DRid', 'id');
    }
}
