<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveInspectionreports extends Model
{
    use HasFactory;
    public $table='save_inspection_reports';
    protected $fillable = [
        'state',
        'city',
        'zip_code',
        'LEGAL_NAME',
        'DBA_NAME',
        'BUS_STREET_PO',
        'fileName',
        'BUS_TELNO',
        'orderPrice',
        'user_id',
        'orderQuantity',
        'is_saved',
    ];
}
