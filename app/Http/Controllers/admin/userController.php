<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\college;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // صفحة إنشاء مستخدم جديد
    public function create()
    {
        $colleges = college::all();
        return view('admin.users.create', compact('colleges'));
    }

    // حفظ مستخدم جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'grade' => 'required',
            'college_id' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'grade' => $request->grade,
            'college_id' => $request->college_id
        ]);

        return redirect()->route('admin.users')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    // عرض مستخدم واحد
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // صفحة تعديل مستخدم
    public function edit(User $user)
    {
        $colleges = college::all();
        return view('admin.users.edit', compact('user', 'colleges'));
    }

    // تحديث بيانات المستخدم
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'grade' => 'required',
            'college_id' => 'required'
        ]);

        $data = $request->except('_token');

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed'
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'تم تحديث البيانات بنجاح');
    }

    // حذف مستخدم
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
