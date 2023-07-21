<?php

// Livestock.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;

    protected $table = "livestock";
    protected $primaryKey = "Lid";
    protected $fillable = [
        'Fid',
        'Ltid',
        'Quantity',
    ];

    public $timestamps = false;

    public function livt()
    {
        return $this->belongsTo(LivestockType::class, 'Ltid', 'Ltid');
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'Fid', 'Fid');
    }
}

