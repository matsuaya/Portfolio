<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rest;
use App\History;
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
        
        return redirect('user/offer/');
    }
    
    public function editIndex(Request $request)
    {
        return view('user.edit');
    }
    
    public function edit(Request $request)
    {
        //Validationをかける
        $this->validate($request,History::$rules);
        $history=new History;
        //送信されてきたフォームデータを格納する
        $history_form=$request->all();
        $history->fill($history_form);
        $history->save();
        
        return redirect('user/edit/');
    }
    
    public function listView(Request $request)
    {
        $days=History::all();
        return view('user.calendar',['days'=>$days]);
    }
    
    public function listEdit(Request $request)
    {
        return view('user.calendar');
    }
}
