<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $email = Auth::user()->email;
        if($email == "admin@gmail.com" || $email == "muhammadrikzan31@gmail.com"){
            $users = User::get();
            return view('admin.user',[
                'users' => $users
            ]);
        }

        return "Tidak diizinkan";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route("user.index")->with('danger', $validator->errors()->first());
        }
        DB::beginTransaction();
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            return redirect()->route("user.index")->with('status', "Sukses menambahkan user");
        }catch(\Exception $e){
            DB::rollback();
            $ea = "Terjadi Kesalahan saat menambahkan user: ".$e->getMessage();
            return redirect()->route("user.index")->with('danger', $ea);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',  
            'email' => 'required',  
        ]);
        
        if($validator->fails()){
            return redirect()->route("user.index")->with('danger', $validator->errors()->first());
        }
        DB::beginTransaction();
        try{
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->has('password') && $request->password != NULL && $request->password != ""){
                $user->password = bcrypt($request->password);
            }
            $user->save();
            DB::commit();
            return redirect()->route("user.index")->with('status', "Sukses mengedit user");
        }catch(\Exception $e){
            DB::rollback();
            $ea = "Terjadi Kesalahan saat mengedit user: ".$e->getMessage();
            return redirect()->route("user.index")->with('danger', $ea);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if($user->email == "admin@gmail.com"){
            return redirect()->route("user.index")->with('danger', "Terjadi Kesalahan");
        }
        
        if(User::count() > 1){
            if(User::destroy($id)){
                return redirect()->route("user.index")->with('status', "Sukses menghapus user");
            }else {
                return redirect()->route("user.index")->with('danger', "Terjadi Kesalahan");
            }
        }else{
            return redirect()->route("user.index")->with('danger', "Terjadi Kesalahan");
        }
    }
}
