<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as data_request;

use App\User as UserEloquent;

use Redirect;
use Request;
use View;

class UserController extends Controller
{
    // public function ShowMember(){
    // 	$id = Request::get('id');

    // 	$member = UserEloquent::findOrFail($id);
    // 	return View::make('member.show_member',['member'=>$member]);
    // }

    public function save(data_request $request){
        if($request->name=="" || $request->email==""){
            return response()->json(['result' => false, 'message' => '請輸入完整資料']);
        }
        elseif(!preg_match("/.+@.+\.+.[a-zA-Z]{1,4}$/", $request->email)){
            return response()->json(['result' => false, 'message' => '信箱格式錯誤']);
        }
        else{
            $mail = UserEloquent::where('email',$request->email)->get();

            if(count($mail)==0){
                $member = UserEloquent::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt('123456'),
                    'remember_token' => 1
                ]);
                
                return response()->json(['result' => true, 'message' => '成功建立 1 個人員']);
            }
            else{
                return response()->json(['result' => false, 'message' => '信箱已被註冊，無法使用']);
            }       
        }
    }

    // public function UpdateMember(){
    // 	$id = Request::get('id');

    //     $member = UserEloquent::findOrFail($id);
    //     return View::make('member.up_member',['member'=>$member]);
    // }

    // public function postUpdateMember(data_request $request){
    //     if($request->name=="" || $request->email==""){
    //         return Redirect::back()->withErrors(['msg'=>'請輸入完整']);
    //     }
    //     elseif(!preg_match("/.+@.+\.+.[a-zA-Z]{1,4}$/", $request->email)){
    //         return Redirect::back()->withErrors(['msg'=>'信箱格式錯誤']);
    //     }
    //     else{
    //         $mail = UserEloquent::where('email',$request->email)->get();

    //         if(count($mail)==0){
    //             $id = Request::get('id');
    //             $member = UserEloquent::FindOrFail($id);

    //             $member->name = $request->name;
    //             $member->email = $request->email;
    //             $member->save();

    //             return Redirect::back()->with('success','修改成功');
    //         }
    //         else{
    //             return Redirect::back()->withErrors(['msg'=>'信箱已被註冊，無法使用']);
    //         }       
    //     }
    // }

    // public function DeleteMember(){
    //     $id = Request::get('id');

    // 	$member = UserEloquent::findOrFail($id);
    // 	$member->delete();

    // 	return Redirect::back()->with('success','1');
    // }
}