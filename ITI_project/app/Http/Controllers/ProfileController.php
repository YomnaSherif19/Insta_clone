<?php
namespace App\HTTP\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\followship;
use App\Models\User;
use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth;

use Image;

class ProfileController extends Controller{

    public function index(){
if(Auth::check()){
    $followers=followship::where('user1_id','!=',auth()->user()->id)->get();
    $following=followship::where('user1_id',auth()->user()->id)->get();
    //$posts=Post::where('user_id','!=',auth()->user()->id)->get();
     $user=User::get();//we can use it to count all users in db
     return view('users.index',compact("followers","following","user"/*,"posts","user"*/));
}
        // $user=auth()->user();
        // $data['user']=$user;
        else{
            return view('users.index');

        }
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        return redirect()->route('users.index');

    }
    public function show(){
        
        return view('users.edit');//show is used to display edit.blade
    }
    // public function showfollowers(){
    //     return view('users.followers');//to show followers view
    // }
   
   
    public function edit(){
        $user=auth()->user();
        $data['user']=$user;
        return redirect()->route('users.index',$data);
     
    }
    public function update(Request $request){
        $user=auth()->user();
        // if($request->hasFile('image')){
        //     $image=$request->file('image');//requesting from db image col
        //     $filename=time(). '.' .$image->getClientOriginalExtension(); 
        //     // Image::make($image)->resize(300,300)->save(public_path('/storage/images/' .$filename));
        //     $image->store(public_path('/storage/images/' .$filename));
        //    //$users=Auth::users();
        // $user->image=$filename;
        // // $user->store();
        //     }
        if(request()->hasFile('image')){
            $path=request()->file('image')->store('images','public');//images is the folder to upload avatars to
            $user->update([
                'image'=>$request->image,//avatar
            ]);
        }
        else{
            $path='user.png';
        }
        $user->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'phone'=>$request->phone,
          //  'image'=>$request->image,//avatar
             'website'=>$request->website,
             'bio'=>$request->bio,
             'password'=>$request->password,
        ]);
        
        return redirect()->route('users.index')->with('success','profile updated successfully');

    }
    // public function followers(){
    //     return view('users.followers');
    // }
}