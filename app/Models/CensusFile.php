<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CensusFile extends Model
{
    use HasFactory;

    protected $table = 'Census-file';

    protected $fillable = [
        'state_code',
        'city',
        'phy_zip',
        'cls',
        'power_units',
        'private_passenger',
        'hazmat_indicator',
        'carship',
        'genfreight',
        'household',
        'metalsheet',
        'motorveh',
        'drivetow',
        'logpole',
        'bldgmat',
        'mobilehome',
        'machlrg',
        'produce',
        'liqgas',
        'intermodal',
        'passengers',
        'oilfield',
        'livestock',
        'grainfeed',
        'coalcoke',
        'meat',
        'garbage',
        'usmail',
        'chem',
        'drybulk',
        'coldfood',
        'beverages',
        'paperprod',
        'utility',
        'farmsupp',
        'construct',
        'waterwell',
        'cargoother',
    ];
}
