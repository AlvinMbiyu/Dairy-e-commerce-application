<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drequests extends Model
{
    use HasFactory;

    protected $table = "_avg_amount";
    protected $fillable = [

        'Fid',
        'Total_avg_amount',
        'No_of_livestock'
    ];

    public function Farmers() {
        return $this ->belongsTo(Farmers::class, 'Fid');
    }

}
