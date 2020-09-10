<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SvController extends Controller
{
    public function versions(Request $request)
    {
        // ゲームIDに対応するランキング情報を取得
        $responseJson = [
            'version' => config('version.ver')
        ];
 
        return response()->json($responseJson);
    }
}
