<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryperson extends Model
{
    use HasFactory;

    protected $table = "_farmers_payment";
    protected $primaryKey = "FPid";
    protected $fillable = [
        
        'Milk_collection_id',
        'Pid',
        'Gid',
        'Payment_confirmation'
    ];

    public function MilkCollection(){
        return $this->belongsTo(MilkCollection::class, 'milk_collection_id');
    }

    public function Payment(){
        return $this->belongsTo(Payment::class, 'Pid');
    }

    public function FarmerGroups(){
        return $this->belongsTo(FarmerGroups::class, 'Gid');
    }
}
