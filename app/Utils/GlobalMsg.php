<?php
namespace App\Utils;

use App\Utils\GlobalCode;

trait GlobalMsg
{

    public function __construct(){}

    public function codeSuccess(string $msg = "成功", array $data = []):object
    {
        return response()->json([
            'status' => GlobalCode::SUCEESS,
            'msg' => $msg,
            'data' => $data
        ]);
    }

    public function codeError(string $msg = "失败", array $data = [])
    {

        return response()->json([
            'status' => GlobalCode::ERROR,
            'msg' => $msg,
            'data' => $data
        ]);
    }
}
