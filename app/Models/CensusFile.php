<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CensusFile extends Model
{
    use HasFactory;

    protected $table = 'Census-file';

    public function scopeFilterByCriteria($query, array $criteria)
   {
       return $query->where(function ($query) use ($criteria) {
           if (!empty($criteria['state'])) {
               $query->where('PHY_ST', '=', $criteria['state']);
           }
           if (!empty($criteria['city'])) {
               $query->where('PHY_CITY', '=', $criteria['city']);
           }
           if (!empty($criteria['zip_code'])) {
               $query->where('PHY_ZIP', '=', $criteria['zip_code']);
           }
           if (!empty($criteria['cls'])) {
               $query->where('class', '=', $criteria['cls']);
           }
           if (!empty($criteria['Carship'])) {
               $query->where('CARSHIP', '=', $criteria['Carship']);
           }
           if (!empty($criteria['TOT_PWR_FROM']) && !empty($criteria['TOT_PWR_TO'])) {
               $query->whereBetween('TOT_PWR', [$criteria['TOT_PWR_FROM'], $criteria['TOT_PWR_TO']]);
           }
           if (!empty($criteria['Private_passenger'])) {
               $query->where('PASSENGERS', '=', $criteria['Private_passenger']);
           }
           if (!empty($criteria['Genfreight'])) {
               $query->where('GENFREIGHT', '=', $criteria['Genfreight']);
           }
           if (!empty($criteria['Household'])) {
               $query->where('HOUSEHOLD', '=', $criteria['Household']);
           }
           if (!empty($criteria['Metalsheet'])) {
               $query->where('METALSHEET', '=', $criteria['Metalsheet']);
           }
           if (!empty($criteria['Motorveh'])) {
               $query->where('MOTORVEH', '=', $criteria['Motorveh']);
           }
           if (!empty($criteria['Drivetow'])) {
               $query->where('DRIVETOW', '=', $criteria['Drivetow']);
           }
           if (!empty($criteria['Logpole'])) {
               $query->where('LOGPOLE', '=', $criteria['Logpole']);
           }
           if (!empty($criteria['Bldgmat'])) {
               $query->where('BLDGMAT', '=', $criteria['Bldgmat']);
           }
           if (!empty($criteria['MobileHome'])) {
               $query->where('MOBILEHOME', '=', $criteria['MobileHome']);
           }
           if (!empty($criteria['Machlrg'])) {
               $query->where('MACHLRG', '=', $criteria['Machlrg']);
           }
           if (!empty($criteria['Produce'])) {
               $query->where('PRODUCE', '=', $criteria['Produce']);
           }
           if (!empty($criteria['Liqgas'])) {
               $query->where('LIQGAS', '=', $criteria['Liqgas']);
           }
           if (!empty($criteria['Oilfield'])) {
               $query->where('OILFIELD', '=', $criteria['Oilfield']);
           }
           if (!empty($criteria['Livestock'])) {
               $query->where('LIVESTOCK', '=', $criteria['Livestock']);
           }
           if (!empty($criteria['Coalcoke'])) {
               $query->where('COALCOKE', '=', $criteria['Coalcoke']);
           }
           if (!empty($criteria['Meat'])) {
               $query->where('MEAT', '=', $criteria['Meat']);
           }
           if (!empty($criteria['Garbage'])) {
               $query->where('GARBAGE', '=', $criteria['Garbage']);
           }
           if (!empty($criteria['Chem'])) {
               $query->where('CHEM', '=', $criteria['Chem']);
           }
           if (!empty($criteria['Drybulk'])) {
               $query->where('DRYBULK', '=', $criteria['Drybulk']);
           }
           if (!empty($criteria['Coldfood'])) {
               $query->where('COLDFOOD', '=', $criteria['Coldfood']);
           }
           if (!empty($criteria['Grainfeed'])) {
               $query->where('GRAINFEED', '=', $criteria['Grainfeed']);
           }
           if (!empty($criteria['Intermodal'])) {
               $query->where('INTERMODAL', '=', $criteria['Intermodal']);
           }
           if (!empty($criteria['Usmail'])) {
               $query->where('USMAIL', '=', $criteria['Usmail']);
           }
           if (!empty($criteria['Beverages'])) {
               $query->where('BEVERAGES', '=', $criteria['Beverages']);
           }
           if (!empty($criteria['Paperprod'])) {
               $query->where('PAPERPROD', '=', $criteria['Paperprod']);
           }
           if (!empty($criteria['Utility'])) {
               $query->where('UTILITY', '=', $criteria['Utility']);
           }
           if (!empty($criteria['Farmsupp'])) {
               $query->where('FARMSUPP', '=', $criteria['Farmsupp']);
           }
           if (!empty($criteria['Construct'])) {
               $query->where('CONSTRUCT', '=', $criteria['Construct']);
           }
           if (!empty($criteria['Waterwell'])) {
               $query->where('WATERWELL', '=', $criteria['Waterwell']);
           }
           if (!empty($criteria['Cargoother'])) {
               $query->where('CARGOOTHR', '=', $criteria['Cargoother']);
           }
           if (!empty($criteria['Hazmat_indicator'])) {
               $query->where('HM_IND', '=', $criteria['Hazmat_indicator']);
           }
       });
   }
}
