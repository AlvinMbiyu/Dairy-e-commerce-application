<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;

    protected $table = "_livestock";
    protected $primarykey = "_livestock_id";
    protected $fillable = [

        'Quantity',
        'Fid',
        'Ltid'
    ];

    public function Farmers() {
        return $this ->belongsTo(Farmers::class, 'Fid');
    }

    public function LivestockType() {
        return $this ->belongsTo(LivestockType::class, 'Ltid');
    }
}
