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
        $key = $request->input('key', '');
        $lastConfig = $request->user()->getLastConfig($key);
        $config = '';
        if (!empty($lastConfig)) {
            $config = unserialize($lastConfig->value);
        }

        return [
           'status' => true,
           'config' => $config
        ];
    }

    public function store(Request $request)
    {
        $comment = $request->user()->configs()->create([
            'key'   => $request->input('key', ''),
            'value' => serialize($request->input('config', ''))
        ]);

        if (!$comment) {
            return $this->failed('配置更新失败!');
        }

        $data = ['message' => '配置更新成功', 'data' => $request->all()];
        return $this->success($data);
    }
}
