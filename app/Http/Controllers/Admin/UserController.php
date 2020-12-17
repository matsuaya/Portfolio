<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rest;
use App\History;
use Carbon\Carbon;
use Storage;

class UserController extends Controller
{
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
}
