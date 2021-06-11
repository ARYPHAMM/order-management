<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function login() // check trạng thái login
    {
        if (Auth::check()) {
            return view('home');
        } else {
            return view('auth.login');
        }
    }
    public function authenticate(Request $request) // xác thực đăng nhập
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
        return redirect()->route('home')->with('error', 'Oppes! You have entered invalid credentials');
    }
    public function accountInfor() // thông tin tài khoản
    {
        return view('auth.infor');
    }
    public function register() // đăng ký
    {
        return view('auth.register');
    }
    public function changePassword() // đổi mật khẩu
    {
        return view('auth.passwords.reset');
    }
    public function logout() // đăng xuất
    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function updatePassword(Request $request) // xử lý đổi mật khẩu
    {
        $rules = [
            'password' => 'required|string|min:8:|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
        $customMessages = [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'min' => ':attribute độ dài mật khẩu ít nhất 8 ký tự',
            'confirmed' => ':attribute không khớp',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages, [
            'password' => 'Mật khẩu mới',
            'password_confirmation' => 'Nhập lại mật khẩu mới',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password_confirmation);
            $user->update();
            return redirect()->route('home');
        }
    }
    public function createUser(Request $request) // tạo user mới
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $rules = [
            'password' => 'required|string|min:8:|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
        $customMessages = [
            'unique' => ':attribute đã tồn tại',
            'max' => ':attribute tối đa 255',
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'min' => ':attribute độ dài mật khẩu ít nhất 8 ký tự',
            'confirmed' => ':attribute không khớp',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages, [
            'password' => 'Mật khẩu mới',
            'password_confirmation' => 'Nhập lại mật khẩu mới',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect('login');
        }
    }
}
