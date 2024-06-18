<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CensusFile extends Model
{
    use HasFactory;

    protected $table = 'Census-file';

    // protected $fillable = [
    //     'state_code',
    //     'city',
    //     'phy_zip',rchar(555)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	NAME_DBA	varchar(555)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	ACT_STAT	varchar(555)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	CARSHIP	varchar(555)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	DBNUM	varchar(555)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	PHY_NATN	varchar(555)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	REG	varchar(555)	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
    public function scopeFilterByCriteria($query,$state, $Phy_city, $zip_code, $cls, $Carship, $TOT_PWR_FROM, $TOT_PWR_TO, $Genfreight, $Household, $Metalsheet, $Motorveh, $Drivetow, $Logpole, 
    $Bldgmat, $MobileHome, $Machlrg, $Produce, $Liqgas, $Private_passenger, $Oilfield, $Livestock, $Coalcoke, $Meat, $Garbage, $Chem, $Drybulk, $Coldfood, $Utility, $Intermodal, 
    $Usmail, $Beverages, $Paperprod, $Farmsupp, $Construct, $Waterwell, $Cargoother, $Grainfeed, $Hazmat_indicator)
    {
        return $query->where(function ($query) use ($state, $Phy_city, $zip_code, $cls, $Carship, $TOT_PWR_FROM, $TOT_PWR_TO, $Genfreight, $Household, $Metalsheet, $Motorveh, $Drivetow, $Logpole, 
        $Bldgmat, $MobileHome, $Machlrg, $Produce, $Liqgas, $Private_passenger, $Oilfield, $Livestock, $Coalcoke, $Meat, $Garbage, $Chem, $Drybulk, $Coldfood, $Utility, $Intermodal, 
        $Usmail, $Beverages, $Paperprod, $Farmsupp, $Construct, $Waterwell, $Cargoother, $Grainfeed, $Hazmat_indicator) {
            if ($state != '') {
                $query->where('PHY_ST', '=', $state);
            }
            if ($Phy_city != '') {
                $query->where('PHY_CITY', '=', $Phy_city);
            }
            if ($zip_code != '') {
                $query->where('PHY_ZIP', '=', $zip_code);
            }
            if ($cls != '') {
                $query->Where('class', $cls);
            }
            if ($Carship != '') {
                $query->Where('CARSHIP', $Carship);
            }
            if ($TOT_PWR_FROM != '' && $TOT_PWR_TO != '') {
                $query->whereBetween('TOT_PWR', [$TOT_PWR_FROM, $TOT_PWR_TO]);
            }
            if ($Private_passenger != '') {
                $query->Where('PASSENGERS', $Private_passenger);
            }
            if ($Genfreight != '') {
                $query->Where('GENFREIGHT', $Genfreight);
            }
            if ($Household != '') {
                $query->Where('HOUSEHOLD', $Household);
            }
            if ($Metalsheet != '') {
                $query->Where('METALSHEET', $Metalsheet);
            }
            if ($Motorveh != '') {
                $query->Where('MOTORVEH', $Motorveh);
            }
            if ($Drivetow != '') {
                $query->Where('DRIVETOW', $Drivetow);
            }
            if ($Logpole != '') {
                $query->Where('LOGPOLE', $Logpole);
            }
            if ($Bldgmat != '') {
                $query->Where('BLDGMAT', $Bldgmat);
            }
            if ($MobileHome != '') {
                $query->Where('MOBILEHOME', $MobileHome);
            }
            if ($Machlrg != '') {
                $query->Where('MACHLRG', $Machlrg);
            }
            if ($Produce != '') {
                $query->Where('PRODUCE', $Produce);
            }
            if ($Liqgas != '') {
                $query->Where('LIQGAS', $Liqgas);
            }
            if ($Oilfield != '') {
                $query->Where('OILFIELD', $Oilfield);
            }
            if ($Livestock != '') {
                $query->Where('LIVESTOCK', $Livestock);
            }
            if ($Coalcoke != '') {
                $query->Where('COALCOKE', $Coalcoke);
            }
            if ($Meat != '') {
                $query->Where('MEAT', $Meat);
            }
            if ($Garbage != '') {
                $query->Where('PHY_CITY', $Garbage);
            }
            if ($Chem != '') {
                $query->Where('CHEM', $Chem);
            }
            if ($Drybulk != '') {
                $query->Where('DRYBULK', $Drybulk);
            }
            if ($Coldfood != '') {
                $query->Where('COLDFOOD', $Coldfood);
            }
            if ($Intermodal != '') {
                $query->Where('INTERMODAL', $Intermodal);
            }
            if ($Usmail != '') {
                $query->Where('USMAIL', $Usmail);
            }
            if ($Beverages != '') {
                $query->Where('BEVERAGES', $Beverages);
            }
            if ($Paperprod != '') {
                $query->Where('PAPERPROD', $Paperprod);
            }
            if ($Utility != '') {
                $query->Where('UTILITY', $Utility);
            }
            if ($Farmsupp != '') {
                $query->Where('FARMSUPP', $Farmsupp);
            }
            if ($Construct != '') {
                $query->Where('CONSTRUCT', $Construct);
            }
            if ($Waterwell != '') {
                $query->Where('WATERWELL', $Waterwell);
            }
            if ($Cargoother != '') {
                $query->Where('CARGOOTHR', $Cargoother);
            }
            if ($Hazmat_indicator != '') {
                $query->Where('HM_IND', $Hazmat_indicator);
            }
        })->select(
            'DOT_NUMBER',
            'NAME',
            'NAME_DBA',
            'PHY_STR',
            'PHY_CITY',
            'PHY_ST',
            'PHY_ZIP',
            'TEL_NUM',
            'CARSHIP', 
            'TOT_PWR',
            'HM_IND',
            'PASSENGERS', 
            'GENFREIGHT', 
            'HOUSEHOLD', 
            'METALSHEET', 
            'MOTORVEH', 
            'DRIVETOW', 
            'LOGPOLE', 
            'BLDGMAT', 
            'MOBILEHOME', 
            'MACHLRG', 
            'PRODUCE', 
            'OILFIELD', 
            'LIVESTOCK', 
            'COALCOKE', 
            'MEAT', 
            'CHEM', 
            'DRYBULK', 
            'COLDFOOD', 
            'INTERMODAL', 
            'USMAIL', 
            'BEVERAGES', 
            'PAPERPROD', 
            'UTILITY', 
            'FARMSUPP', 
            'CONSTRUCT', 
            'WATERWELL', 
            'CARGOOTHR'
        );
    }


      
}