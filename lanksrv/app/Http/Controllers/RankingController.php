<?php

namespace App\Http\Controllers;
use App\Ranking;
use App\Services\RankingService;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    protected $rankingService;
 
    public function __construct(RankingService $rankingService)
    {
        $this->rankingService = $rankingService;
    }
 
    public function get(Request $request)
    {
        // ゲームIDに対応するランキング情報を取得
        $rankings = Ranking::where('game_id', $request['game_id'])->get();
 
        // Unity側のJsonUtilityでrootが配列だと受け取れないので1クッション挟む
        $responseJson = [
            'rankings' => $rankings
        ];
 
        return response()->json($responseJson);
    }
 
    public function checkRankin(Request $request)
    {
        // ランク取得
        $rank = $this->rankingService->getScoreRank($request['game_id'], $request['score']);
 
        // ランクが10以内であればランクイン
        $result_rankin = false;
        if ($rank <= 10) {
            $result_rankin = true;
        }
 
        $responseJson = [
            'rankin' => $result_rankin,
            'rank' => $rank,
        ];
 
        return response()->json($responseJson);
    }
 
    public function regist(Request $request)
    {
        $this->rankingService->registRanking($request);
 
        $responseJson = [
            'result' => true,
        ];
 
        return response()->json($responseJson);
    }
}
