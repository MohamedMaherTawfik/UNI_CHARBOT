<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\college;
use App\Models\subjects;
use App\Models\User;
use Illuminate\Http\Request;

class subjectController extends Controller
{
    public function index()
    {
        $subjects = subjects::with(['user', 'college'])->latest()->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    // صفحة إنشاء مادة
    public function create()
    {
        $users = User::all();
        $colleges = college::all();
        return view('admin.subjects.create', compact('users', 'colleges'));
    }

    // حفظ مادة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'college_id' => 'nullable|exists:colleges,id',
            'subject_name' => 'nullable|string|max:255|unique:subjects,subject_name',
            'subject_code' => 'nullable|string|max:255|unique:subjects,subject_code',
            'subject_description' => 'nullable|string',
        ]);

        subjects::create([
            'user_id' => $request->user_id,
            'college_id' => $request->college_id,
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code,
            'subject_description' => $request->subject_description,
        ]);

        return redirect()->route('admin.subjects')->with('success', 'تم إضافة المادة بنجاح');
    }

    // عرض مادة واحدة
    public function show(subjects $subject)
    {
        $subject->load(['user', 'college']);
        return view('admin.subjects.show', compact('subject'));
    }

    // صفحة تعديل مادة
    public function edit(subjects $subject)
    {
        $users = User::all();
        $colleges = college::all();
        return view('admin.subjects.edit', compact('subject', 'users', 'colleges'));
    }

    // تحديث مادة
    public function update(Request $request, subjects $subject)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'college_id' => 'nullable|exists:colleges,id',
            'subject_name' => 'nullable|string|max:255|unique:subjects,subject_name,' . $subject->id,
            'subject_code' => 'nullable|string|max:255|unique:subjects,subject_code,' . $subject->id,
            'subject_description' => 'nullable|string',
        ]);

        $subject->update([
            'user_id' => $request->user_id,
            'college_id' => $request->college_id,
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code,
            'subject_description' => $request->subject_description,
        ]);

        return redirect()->route('admin.subjects')->with('success', 'تم تحديث المادة بنجاح');
    }

    // حذف مادة
    public function destroy(subjects $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects')->with('success', 'تم حذف المادة بنجاح');
    }
}
