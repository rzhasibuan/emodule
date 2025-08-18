<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        // dd(Auth::check());
        return view('admin/dashboard');
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

}
