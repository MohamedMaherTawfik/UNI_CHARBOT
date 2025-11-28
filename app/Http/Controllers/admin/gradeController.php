<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\grades;
use Illuminate\Http\Request;

class gradeController extends Controller
{
    public function index()
    {
        $grades = grades::latest()->get();
        return view('admin.grades.index', compact('grades'));
    }

    // صفحة إضافة درجة
    public function create()
    {
        return view('admin.grades.create');
    }

    // حفظ درجة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'grade_name' => 'nullable|string|max:255',
            'grade_code' => 'nullable|string|max:255',
            'grade_description' => 'nullable|string',
        ]);

        grades::create([
            'grade_name' => $request->grade_name,
            'grade_code' => $request->grade_code,
            'grade_description' => $request->grade_description,
        ]);

        return redirect()->route('admin.grades')->with('success', 'تم إضافة الدرجة بنجاح');
    }

    // عرض درجة واحدة
    public function show(grades $grade)
    {
        return view('admin.grades.show', compact('grade'));
    }

    // صفحة تعديل درجة
    public function edit(grades $grade)
    {
        return view('admin.grades.edit', compact('grade'));
    }

    // تحديث الدرجة
    public function update(Request $request, grades $grade)
    {
        $request->validate([
            'grade_name' => 'nullable|string|max:255',
            'grade_code' => 'nullable|string|max:255',
            'grade_description' => 'nullable|string',
        ]);

        $grade->update([
            'grade_name' => $request->grade_name,
            'grade_code' => $request->grade_code,
            'grade_description' => $request->grade_description,
        ]);

        return redirect()->route('admin.grades')->with('success', 'تم تحديث الدرجة بنجاح');
    }

    // حذف درجة
    public function destroy(grades $grade)
    {
        $grade->delete();
        return redirect()->route('admin.grades')->with('success', 'تم حذف الدرجة بنجاح');
    }
}