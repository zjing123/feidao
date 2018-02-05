<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlySetting extends Model
{
    protected $fillable = [
        'number', 'angles', 'gravity', 'power', 'scale', 'rx', 'ry', 'rz', 'auto_interval'
    ];
}
