<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rest;
use App\History;
use App\User;
use Carbon\Carbon;
use Storage;
use App\Http\Traits\Csv;
use Auth;

class UserController extends Controller
{
    use Csv;
    
    public function applyIndex(Request $request)
    {
        $employee_code=Auth::user()->employee_code;
        $applications=Rest::where('employee_code',$employee_code)->get();
        
        return view('user.offer',['applications'=>$applications]);
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
        $history->fill_history($request)->save();
        
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
        $year=new Carbon;
        $year=Carbon::now()->format('Y');
        $month=new Carbon;
        $month=Carbon::now()->format('m');
        $day=new Carbon;
        $day=Carbon::now()->format('t');
        $histories = User::getCurrentHistories($year,$month);

        return view('user.calendar',['histories'=>$histories,'year'=>$year,'month'=>$month,'day'=>$day]);
    }
    
    public function listEdit(Request $request)
    {
        return view('user.calendar');
    }
    
    public function listChange(Request $request)
    {
        $year = substr($request->change,0,4);
        $month = substr($request->change, -2);
        $day = new Carbon();
        $day = Carbon::create($year,$month,1,0,0,0);
        $day = $day->format('t');
        $histories = User::getCurrentHistories($year,$month);
        return view('user.calendar',['histories'=>$histories,'year'=>$year,'month'=>$month,'day'=>$day]);
    }
    
    public function csvExport(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $historiesResults = User::getCurrentHistories($year,$month);

        $filename = 'workHistories.csv';
        $file = Csv::createCsv($filename);
    
        // ヘッダー
        Csv::write($file, ['社員ID', '始業時刻','終業時刻','休憩時間']); 
    
    
        // 値を入れる
        foreach ($historiesResults as $row) {
            $list = [
                $row->employee_code,
                $row->start_time,
                $row->end_time,
                $row->break_time,
            ];
            
            Csv::write($file, $list);
        };
    
        $response = file_get_contents($file);
    
        // ストリーム(出力用)に入れたら実ファイル(laravel)は削除
        Csv::purge($filename);
    
        return response($response, 200)
                 ->header('Content-Type', 'text/csv')
                 ->header('Content-Disposition', 'attachment; filename='.$filename);
    }
    
}
