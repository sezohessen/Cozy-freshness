<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table="settings";
    protected $fillable=[
        "appname",
        "logo",
        "description",
        "address",
        "facebook",
        "instagram",
        "whatsapp",
        "mail",
        "BGshop"
    ];
}
