<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentItemAttribute extends Model
{
    //
    public function shipment_type()
    {
        return $this->belongsTo(ShipmentType::class);
    }
}
