<?php namespace App\Http\Controllers;


 
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


 




class UserController extends Controller
{
    //show register/create form
    public function create(){
        return view ('users.register');
    }

    // krijo new user
    public function store(Request $request){
        $formFields=$request->validate([
            'name'=>['required','min:3'],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>'required|confirmed|min:6'

        ]);
        //hashpassword
        $formFields['password']=bcrypt($formFields['password']);
        //create user  
        $user= User::create($formFields);
        //login
        auth()->login($user);

        return redirect('/')->with('message','Perdoruesi u krijua dhe u kyq');

    }

    //logout user
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('message','Ju keni dalur nga llogaria');






    }
    //login user form
    public function login(Request $request){

        return view ('users.login');

    }
    //auth user
    public function authenticate (Request $request){
        $formFields=$request->validate([
             
            'email'=>['required','email' ],
            'password'=>'required '
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','Ju jeni qasur ne llogarine tuaj');
        }

        return back()->withErrors(['email'=> ' kredencialet e gabuara'])->onlyInput('email');

        
    }
}
