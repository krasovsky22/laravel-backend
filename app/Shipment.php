<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public function shipment_items()
    {
        return $this->hasMany(ShipmentItem::class);
    }

    public function shipment_type()
    {
        return $this->belongsTo('App\ShipmentType')->withDefault();
    }

    public function pick_up_location()
    {
        return $this->hasOne(Location::class);
    }

    public function delivery_location()
    {
        return $this->hasOne(Location::class);
    }
}
