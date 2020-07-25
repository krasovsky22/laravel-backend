<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentItem extends Model
{
    public function shipment()
    {
        return $this->belongsTo(shipment::class);
    }

    public function shipment_item_attribute_values()
    {
        return $this->hasMany(ShipmentItemAttributeValue::class);
    }
}
