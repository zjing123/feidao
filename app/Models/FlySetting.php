<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlySetting extends Model
{
    protected $fillable = [
        'number', 'angles', 'gravity', 'power', 'scale', 'rx',
        'ry', 'rz', 'auto_interval', 'auto_y', 'auto_y', 'auto_d',
        'hit_pow', 'auto_reward_mul', 'perfect_mul', 'level_up_pow',
        'buy_demand_mul', 'buy_demand_pow', 'buy_auto_mul', 'buy_auto_pow'
    ];
}
