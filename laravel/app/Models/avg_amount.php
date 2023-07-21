<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avg_amount extends Model
{
    use HasFactory;
    protected $table = "avg_amount";
    protected $primarykey = "id";
    protected $fillable = [
        'Fid',
        'Total_avg_amount',
        'No_of_liv'
    ];

    public $timestamps = false;

    public function farmer(){
        return $this->belongsTo(Farmers::class, 'Fid', 'Fid');
    }

    public static function calculateAveragesForFarmer($farmerId)
    {
        $livestockData = Livestock::where('Fid', $farmerId)->with('livt')->get();

        $totalAvgAmount = 0;
        $totalNoOfLiv = 0;

        foreach ($livestockData as $livestock) {
            $totalAvgAmount += $livestock->livt->Mamount_each * $livestock->Quantity;
            $totalNoOfLiv += $livestock->Quantity;
        }

        // Save the calculated values in the avg_amount table
        $avgAmountRecord = self::updateOrCreate(
            ['Fid' => $farmerId],
            ['Total_avg_amount' => $totalAvgAmount, 'No_of_liv' => $totalNoOfLiv]
        );

        return $avgAmountRecord;
    }
}
