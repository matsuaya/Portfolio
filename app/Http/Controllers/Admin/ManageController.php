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
        $applications=Rest::all();
        return view('admin.permit',['masters'=>$masters,'applications'=>$applications]);
    }
    
    public function update(Request $request)
    {
        //Validationをかける
        $this->validate($request,User::$rules);
        $permit=new User;
        //送信されてきたフォームデータを格納する
        $permit_form=$request->all();
        $permit->fill($permit_form);
        $permit->save();
        
        return redirect('admin/permit/');
    }


}
