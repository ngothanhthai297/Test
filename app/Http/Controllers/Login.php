<?php

namespace App\Http\Controllers;

use App\SessionUser;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'string|required|',
            'password' => 'required|min:6|',
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $checkUserToken = SessionUser::where('user_id', Auth::id())->first();
            if (empty($checkUserToken)) {
                $sessinUser = SessionUser::create([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expried' => date('Y-m=d H:i:s', strtotime('+15 day')),
                    'refresh_token_expried' => date('Y-m=d H:i:s', strtotime('+365 day')),
                    'user_id' =>Auth::id(),
                ]);
            } else {
                $sessinUser = $checkUserToken;
            }
        }else{
            return response()->json('Email or PassWord wrong', 401);
        }
        return response()->json($sessinUser, 200);
    }
    public function userLogout()
    {
        Auth::logout();
        return back();
    }
    public function userRegister()
    {
        return view('register');
    }
    //Xu ly du lieu register
    public function userRegisterSubmit(Request $request)
    {

        $this->validate($request, [
            'name' => 'string|required|min:2',
            'email' => 'string|required|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        // dd($data);
        $status = User::create($data);
        if ($status) {
            return redirect('/login');
        } else {
            echo "Đăng kí không thành công";
        }
        // // dd($check);

    }
    public function userLoginSubmit(Request $request)
    {
        $data = $request->all();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/catelory');
        } else {
            return back();
        }
    }
    public function userLogin()
    {
        return view('login');
    }
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user->update($data);
        //200 OK(The request has successed)
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        //204 No content
        return response()->json(null, 204);
    }
}
