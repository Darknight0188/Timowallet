<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userUpdate;
use App\Http\Requests\changePassword;
use App\Repositories\User\UserRepositoryInterface;
use App\users;
use DB;

class userController extends Controller
{

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }


    // get view form update user
    public function getUpdate($id){
        $user = users::find($id);
        return view('user.update',['user'=>$user]);
    }

    /**
     * post data form view
     * @param $id
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @param App\Http\Requests\userUpdate 
     */
    public function postUpdate(userUpdate $request,$id){
        $user = users::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');
        $user->save();

        return redirect()->route('user.edit',array($user->id))->with('flash_message','Update success!!');
    }
    /**
     * get view form change password
     * @param $id
     */
    public function getChange($id){
        $user = users::find($id);
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
        $user = users::find($id);
        $oldPass = $request->input('oldPassword');
        if($oldPass == $user->password){
            $user->password = bcrypt($request->input('newPassword'));
            $user->save();
            return redirect()->route('user.change_Password',array($user->id))->with('flash_message','Change success!!');
        } else{
            return redirect()->route('user.change_Password',array($user->id))->with('flash_message','Wrong old Password!!');
        }
    }
}
