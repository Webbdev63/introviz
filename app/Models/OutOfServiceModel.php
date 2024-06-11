<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutOfServiceModel extends Model
{
    use HasFactory;
    public $table='CENSUS_INS_ACTIVE';
    public function scopeFilterOutofService($query,$state, $Phy_city, $zip_code, $LEGAL_NAME,$DBA_NAME,$BUS_STREET_PO,$BUS_TELNO )
    {
        return $query->where(function ($query) use ($state, $Phy_city, $zip_code,$LEGAL_NAME,$DBA_NAME,$BUS_STREET_PO,$BUS_TELNO ) {
            if ($state != '') {
                $query->where('BUS_STATE_CODE', '=', $state);
            }
            if ($Phy_city != '') {
                $query->where('BUS_CITY', '=', $Phy_city);
            }
            if ($zip_code != '') {
                $query->where('BUS_ZIP_CODE', '=', $zip_code);
            }
            if ($LEGAL_NAME != '') {
                $query->Where('LEGAL_NAME', $LEGAL_NAME);
            }
            if ($BUS_STREET_PO != '') {
                $query->Where('BUS_STREET_PO', $BUS_STREET_PO);
            }
            if ($DBA_NAME != '') {
                $query->Where('DBA_NAME', $DBA_NAME);
            }
            if ($BUS_TELNO != '') {
                $query->Where('BUS_TELNO', $BUS_TELNO);
            }
         
           
            
        });
    }

}
