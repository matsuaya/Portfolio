<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rest;
use App\History;
use Carbon\Carbon;
use Storage;
use App\Http\Traits\Csv;

class UserController extends Controller
{
    use Csv;
    
    public function applyIndex(Request $request)
    {
        return view('user.offer');
    }
    
    public function restApply(Request $request)
    {
        //Validationをかける
        $this->validate($request,Rest::$rules);
        $rest=new Rest;
        //送信されてきたフォームデータを格納する
        $rest_form=$request->all();
        $rest->fill($rest_form);
        $rest->save();
        
        return redirect('user/calendar/');
    }
    
    public function createIndex(Request $request)
    {
        return view('user.create');
    }
    
    public function create(Request $request)
    {
        //Validationをかける
        $this->validate($request,History::$rules);
        $history=new History;
        //送信されてきたフォームデータを格納する
        $history->fill_history($request);
        
        return redirect('user/calendar/');
    }
    
    public function edit(Request $request)
    {
        $histories=History::find($request->id);

        return view('user.edit',['histories_form'=>$histories]);
    }
    
    public function update(Request $request)
    {
        //Validationをかける
        $this->validate($request,History::$rules);
        $histories=History::find($request->id);
        $histories->fill_history($request)->save();
        
        return redirect('user/calendar/'); 
    }
    
    public function listView(Request $request)
    {
        $today=new Carbon();
        $today=Carbon::now()->format('m');
        $histories=History::whereMonth('start_time',$today )->orderBy('start_time','asc')->get();

        return view('user.calendar',['histories'=>$histories]);
    }
    
    public function listEdit(Request $request)
    {
        return view('user.calendar');
    }
    
    public function csvExport()
    {
        // リスト
        $lists = [
            ['おはよう', 'おやすみ'],
            ['こんにちは', 'さようなら'],
        ];
    
        $filename = 'demo.csv';
        $file = Csv::createCsv($filename);
    
        // ヘッダー
        Csv::write($file, ['header1', 'header2']); 
    
    
        // 値を入れる
        foreach ($lists as $list) {
            Csv::write($file, $list);
        }
    
        $response = file_get_contents($file);
    
        // ストリーム(出力用)に入れたら実ファイル(laravel)は削除
        Csv::purge($filename);
    
        return response($response, 200)
                 ->header('Content-Type', 'text/csv')
                 ->header('Content-Disposition', 'attachment; filename='.$filename);

        /*$headers = [ //ヘッダー情報
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=csvexport.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
 
        $callback = function() 
        {
            
            $createCsvFile = fopen('php://output', 'w'); //ファイル作成
            
            $columns = [ //1行目の情報
                'employee_code',
                'start_time',
                'end_time',
                'break_time',
            ];
 
            mb_convert_variables('SJIS-win', 'UTF-8', $columns); //文字化け対策
    
            fputcsv($createCsvFile, $columns); //1行目の情報を追記
 
            $histories = DB::table('histories');  // データベースのテーブルを指定
 
            $historiesResults = $histories  //データベースからデータ取得
                ->select(['employee_code'
                , 'start_time','end_time','break_time'])
                ->groupby('employee_code')
                ->get();
        
            foreach ($historiesResults as $row) {  //データを1行ずつ回す
                $csv = [
                    $row->employee_code,  //オブジェクトなので -> で取得
                    $row->start_time,
                    $row->end_time,
                    $row->break_time,
                ];
 
                mb_convert_variables('SJIS-win', 'UTF-8', $csv); //文字化け対策
 
                fputcsv($createCsvFile, $csv); //ファイルに追記する
            }
            fclose($createCsvFile); //ファイル閉じる
        };
        
        return response()->stream($callback, 200, $headers); //ここで実行
        */
        
    }
    
}
