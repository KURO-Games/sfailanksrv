<?php
 
namespace App\Services;
 
use App\Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
 
class RankingService {
 
    public function getScoreRank($game_id, $score)
    {
        $query = Ranking::query();
        $query->where('game_id', (int)$game_id);
        $query->where('score', '>=', (int)$score);
 
        $rankings = $query->get()->toArray();
 
        // リクエストスコア以上のスコアを持つレコード数+1をランクとして返す
        return count($rankings) + 1;
    }
 
    public function registRanking(Request $request)
    {
        // リクエストされた順位以下の順位をすべて1下げる
        $query = Ranking::query();
        $query->where('game_id', (int)$request['game_id']);
        $query->where('rank', '>=', (int)$request['rank']);
        $query->orderBy('rank');
        $rankings = $query->get();
 
        $rank = (int)$request['rank'];
        foreach ($rankings as $ranking) {
            $rank += 1;
            $ranking['rank'] = $rank;
 
            $ranking->save();
        }
 
        // リクエスト内容をランキングに登録
        $registRanking = new Ranking();
        $registRanking->game_id = $request['game_id'];
        $registRanking->rank = $request['rank'];
        $registRanking->name = $request['name'];
        $registRanking->score = $request['score'];
        $registRanking->save();
    }
}
