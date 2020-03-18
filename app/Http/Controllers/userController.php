<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userUpdate;
use App\Http\Requests\changePassword;
use App\Repository\UserEloquentRepository;
use Illuminate\Support\Facades\Hash;
use App\User;

class userController extends Controller
{
    protected $userEloquentRepository;

    public function __construct(UserEloquentRepository $userEloquentRepository){
        $this->userEloquentRepository = $userEloquentRepository;
    }

    // get view form update user
    public function getUpdate($id){
        $user = auth()->user();
        return view('user.update',compact('user'));
    }

    /**
     * post data form view
     * @param $id
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @param App\Http\Requests\userUpdate 
     */
    public function postUpdate(userUpdate $request,$id){
        $user = $this->userEloquentRepository->find($id);
        $data = $request->all();
        $this->userEloquentRepository->update($id,$data);

        return redirect()->route('user.edit',array($user->id))->with('flash_message','Update success!!');
    }
    /**
     * get view form change password
     * @param $id
     */
    public function getChange($id){
        $user = $this->userEloquentRepository->find($id);
        return view('user.change',['user'=>$user]);
    }

    /**
     * post data form change password
     * @param $id
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @param App\Http\Requests\changePassword
     */
    public function postChange(changePassword $request,$id){
        $user = $this->userEloquentRepository->find($id);
        $oldPass = $request->input('oldPassword');
        if($oldPass == $user->password){
            $data = Hash::make($request->input('newPassword'));
            $this->userEloquentRepository->update($id,$data);
            return redirect()->route('user.change_Password',array($user->id))->with('flash_message','Change success!!');
        } else{
            return redirect()->route('user.change_Password',array($user->id))->with('flash_message','Wrong old Password!!');
        }
    }
}
