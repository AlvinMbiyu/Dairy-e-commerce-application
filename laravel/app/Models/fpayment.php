<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fpayment extends Model
{
    use HasFactory;
    protected $table = "fpayment";
    protected $primaryKey = "id";
    protected $fillable = [

        'MCid',
        'Fid',
        'pid',
        'Gid',
        'income',
        'Payment_confirmation'
    ];

    public $timestamps = 'false';

    public function MilkCollection()
    {
        return $this->belongsTo(MilkCollection::class, 'MCid');
    }

    public function Payment()
    {
        return $this->belongsTo(Payment::class, 'pid');
    }

    public function FarmerGroups()
    {
        return $this->belongsTo(FarmerGroups::class, 'Gid');
    }
    public function Farmers()
    {
        return $this->belongsTo(Farmers::class, 'Fid');
    }
}
