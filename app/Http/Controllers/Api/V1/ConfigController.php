<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\Api\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Zend\Diactoros\Response;

class ConfigController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $lastConfig = $request->user()->getLastConfig();
        $config = '';
        if (!empty($lastConfig)) {
            $config = $lastConfig->value;
        }

        return $this->success([
            'config' => $config
        ]);
    }

    public function store(Request $request)
    {
        $comment = $request->user()->configs()->create([
            'value' => $request->get('config', '')
        ]);

        if (!$comment) {
            return $this->failed('配置更新失败!');
        }

        return $this->success('配置更新成功');
    }
}
