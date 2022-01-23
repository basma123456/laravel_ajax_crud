<?php

namespace App\Http\Controllers\users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{


    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




     
    public function index()
    {
        $users = User::all()->sortDesc();
        return view('users.index')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
          $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'image' => 'required',
            'password' => 'min:3'
        ]);
        $myImage = $this->getImage($request->image,'photos'); 
        
        
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $myImage,
            'password' => Hash::make($request->password),



        ]);

        return Response::json($users);
    }

/*
    public function edit($id)
    {
            $where = array('id' => $id);
            $users  = User::where($where)->first();
            
            return Response::json($users);
    }*/

    public function edit(User $user)
    {
            $user = $user;
            
            if($user){
                return Response::json(['user'=>$user, 'status'=>200 , 'msg'=>'This user is foun and you can upddate it']);
            }else{

                return Response::json(['msg'=>'This user ins not found', 'status'=>404]);

            }
    }


    /****************************************** */
    public function update($id , Request $request)
    {

        if(!empty($request->password)){
            $password = "password|min:3";
        }else{
            $password = "nullable";


        }

        $request->validate([

            'name' => 'required|string|max:30|min:3',
            'email' => 'email|required',
            'password' => $password,
        ]);


        $id = $id;
        $user = User::find($id);
            if($user){
                    $user->name = $request->name;
                    $user->email = $request->email;

                    if(!empty($request->post('password'))){
                        $user->password = Hash::make($request->post('password'));
                    }else{
                        $user->password = Hash::make($user->getOriginal('password'));

                    }


                    if(!empty($request->image)){
                        $myImage = $this->getImage($request->image,'photos'); 
                        $user->image = $request->image;

                    }else{
                        $user->image = $user->getOriginal('image');

                    }

                $savedAction =    $user->update();
                 if($savedAction){
                    return Response::json(['user'=>$user , 'status'=>200 , 'msg'=>'Congratulation, you have updated this record successfully']);
                        }else{
                            return Response::json(['status'=>400 , 'msg'=>'no, you have not updated this record successfully']);
                    
                        }
            
               }
    }


    // public function destroy(User $user , Request $request)
    // {
    //     //
    //     if($request->ajax()){
    //         $user = User::find($request->my_id);
    //     if($user){
    //     $user->delete();
    //     return Response::json(['user'=>$user , 'msg'=>'Congratulation you have been deleted this record successfully']);
    //     }else{
    //         return Response::json(['msg'=>'sorry, the action is not completed']);

    //     }
    // }
    // }





        public function destroy($id)
    {
        $id = $id;
        User::findOrFail($id)->delete();
        return response()->json(['success' => 'deleted success' , 'id' => $id]);
    }


     
}
