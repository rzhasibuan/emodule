<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $users = \App\Models\User::all();
        $modules = \App\Models\Module::all();
        return view('admin.dashboard', compact('users', 'modules'));
    }

    public function users(){
        $datas = User::all();
        return view('admin/users',compact('datas'));
    }

    public function delete($id_users){
        if(Auth::user()->id_level == '1'){
            $data = User::findOrFail($id_users);
            $deleted = $data->delete();

            if ($deleted) {
                return redirect()
                    ->route('users')
                    ->with([
                        'success' => 'Data Deleted!'
                    ]);
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        }

        return redirect()
        ->back()
        ->with([
            'error' => 'Dont Have Access!'
        ]);
    }

    public function show_user($id_users){
        if(Auth::user()->id_level == '1'){
            $data = User::find($id_users);
            // dd($data);

            return view('admin/showuser',compact('data'));
        }
        return redirect()
        ->back()
        ->with([
            'error' => 'Dont Have Access!'
        ]);

    }

    public function change_user(Request $request,$id_users){
        if(Auth::user()->id_level == '1'){
            // dd($request);

            $data = User::findOrFail($id_users);
            if($request->password == NULL){
                $data->name = $request->name;
                $data->email = $request->email;
                $data->id_level = $request->id_level;
            }else{
                $this->validate($request, [
                    'password' => 'min:6',
                ]);
                $data->name = $request->name;
                $data->email = $request->email;
                $data->id_level = $request->id_level;
                $data->password = bcrypt($request->password);
            }
            $post = $data->update();
            if ($post) {
                return redirect()
                ->route('users')
                ->with([
                    'success' => 'Update Data Success!'
                ]);
            } else {
                return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
            }
        }
        return redirect()
        ->back()
        ->with([
            'error' => 'Dont Have Access!'
        ]);
    }

    public function createUser() {
        // Hanya admin yang boleh akses
        if(Auth::user()->id_level != '1') {
            return redirect()->route('users')->with('error', 'Tidak punya akses!');
        }
        return view('admin.create_user');
    }

    public function storeUser(Request $request) {
        if(Auth::user()->id_level != '1') {
            return redirect()->route('users')->with('error', 'Tidak punya akses!');
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'id_level' => 'required|in:1,2,3',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_level = $request->id_level;
        $user->save();
        return redirect()->route('users')->with('success', 'User berhasil ditambahkan!');
    }

}
