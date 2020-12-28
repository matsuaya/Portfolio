<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Rest;
use Storage;

class ManageController extends Controller
{
    public function manage()
    {
        $masters=User::all();
        $applications=Rest::where('application_status',0)->get();
        return view('admin.permit',['masters'=>$masters,'applications'=>$applications]);
    }
    
    public function update(Request $request)
    {
        //Validationをかける
        $this->validate($request,User::$rules);
        $permit = new User;
        //送信されてきたフォームデータを格納する
        $permit_form = $request->all();
        $hash = password_hash($request['password'], PASSWORD_BCRYPT);
        $permit_form['password'] = $hash;
        $permit->fill($permit_form);
        $permit->save();
        
        return redirect('admin/permit/');
    }

    public function agree(Request $request){
        $rest_form = Rest::find($request->id);
        $rest_form->application_status="1";
        $rest_form->save();

        return redirect('admin/permit/');
    }

}
