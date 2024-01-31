<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function postLogin(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validate)) return redirect()->back();

        return redirect('/');
    }

    public function postRegister(Request $request){
        User::create([
            'name' => $request->name,
            'password' => $request->password,
            'roles_id' => 1
        ]);

        return redirect('/login');
    }

    public function index(){
        $status = ['selesai', 'selesai withdraw'];
        $role_list = [1,2,3];
        if(!Auth::check()) return view('dashboard');
        $products = Product::with('category')->get();

        $users = User::where('roles_id', 1)->with('roles')->get();
        $allUsers = User::latest()->whereIn('roles_id', $role_list)->with('roles')->get();
        $wallets = Wallet::whereIn('status', $status)
        ->where('users_id', Auth::user()->id)
        ->get();
        $credit = $wallets->sum('credit');
        $debit = $wallets->sum('debit');
        $saldo_user = $credit - $debit;
        $roles = Role::all();

        $categories = Category::all();
        $walletsBank = Wallet::latest()->with('user')->where('status', 'proses')->get();
        $withdrawBank = Wallet::latest()->with('user')->where('status', 'proses withdraw')->get();
        $historyTopup = Wallet::latest()->with('user')->where('status', 'selesai')->get();
        $historyWithdraw = Wallet::latest()->with('user')->where('status', 'selesai withdraw')->get();

        if(Auth::user()->roles_id == 1) return view('siswa.index', compact('products', 'saldo_user'));
        if(Auth::user()->roles_id == 2) return view('kantin.index', compact('products', 'categories'));
        if(Auth::user()->roles_id == 3) return view('bank.index', compact('walletsBank', 'withdrawBank', 'users', 'historyTopup', 'historyWithdraw'));
        if(Auth::user()->roles_id == 4) return view('admin.index', compact('allUsers', 'roles', 'categories'));
    }

    public function logout()
    {
        Session::flush();
        Auth::user();
        return view("dashboard");
    }

    public function getLogin(){
        return view('login');
    }

    public function getRegister(){
        return view('register');
    }

     public function putUser(Request $request, $id)
        {
            $user = User::find($id);

            if ($request->password == '') {
                $user->update([
                    'name' => $request->name,
                    'password' => $user->password,
                    'roles_id' => $request->roles_id,
                ]);
            } else {
                $user->update([
                    'name' => $request->name,
                    'password' => $request->password,
                    'roles_id' => $request->roles_id,
                ]);
            }

            return redirect()->back()->with('status', 'success update user');
        }

        public function store(Request $request){
            User::create([
                'name' => $request->name,
                'password' => $request->password,
                'roles_id' => $request->roles_id
            ]);

            return redirect()->back();
        }

        public function destroy($id){
            $user = User::find($id);

            $user->delete();

            return redirect()->back();
        }
}
