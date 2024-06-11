<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveCensusFile extends Model
{
    use HasFactory;
    public $table='save_census_files';
    protected $fillable = [
        'fileName',
        'orderQuantity',
        'state',
        'Phy_city',
        'zip_code',
        'cls',
        'Carship',
        'TOT_PWR_min',
        'TOT_PWR_max',
        'Genfreight',
        'Household',
        'Metalsheet',
        'Motorveh',
        'Drivetow',
        'Logpole',
        'Bldgmat',
        'MobileHome',
        'Machlrg',
        'Produce',
        'Liqgas',
        'Private_passenger',
        'Oilfield',
        'Livestock',
        'Coalcoke',
        'Meat',
        'Garbage',
        'Chem',
        'Drybulk',
        'Coldfood',
        'Utility',
        'Intermodal',
        'Usmail',
        'Beverages',
        'Paperprod',
        'Farmsupp',
        'Construct',
        'Waterwell',
        'Cargoother',
        'Grainfeed',
        'is_saved',
        'orderPrice','user_id','payment_status',
        'Hazmat_indicator'];
}
