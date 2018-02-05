<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\FlySettingsResource;
use App\Models\FlySetting;
use App\Traits\Api\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlysettingController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $settings = FlySetting::orderBy('number', 'asc')->get();

        return $this->success(
            FlySettingsResource::collection($settings)
                ->hide(['created_at', 'updated_at'])
        );
    }
}
