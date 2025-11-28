<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\college;
use Illuminate\Http\Request;

class collegeController extends Controller
{
    // عرض كل الكليات
    public function index()
    {
        $colleges = College::latest()->get();
        return view('admin.colleges.index', compact('colleges'));
    }

    // صفحة إنشاء كلية
    public function create()
    {
        return view('admin.colleges.create');
    }

    // حفظ كلية جديدة
    public function store(Request $request)
    {
        $request->validate([
            'college_name' => 'nullable|string|max:255|unique:colleges,college_name',
            'college_code' => 'nullable|string|max:255|unique:colleges,college_code',
            'college_description' => 'nullable|string',
            'college_location' => 'nullable|string|max:255',
        ]);

        College::create([
            'college_name' => $request->college_name,
            'college_code' => $request->college_code,
            'college_description' => $request->college_description,
            'college_location' => $request->college_location,
        ]);

        return redirect()->route('admin.colleges')->with('success', 'تم إضافة الكلية بنجاح');
    }

    // عرض كلية واحدة
    public function show(College $college)
    {
        return view('admin.colleges.show', compact('college'));
    }

    // صفحة تعديل كلية
    public function edit(College $college)
    {
        return view('admin.colleges.edit', compact('college'));
    }

    // تحديث بيانات الكلية
    public function update(Request $request, College $college)
    {
        $request->validate([
            'college_name' => 'nullable|string|max:255|unique:colleges,college_name,' . $college->id,
            'college_code' => 'nullable|string|max:255|unique:colleges,college_code,' . $college->id,
            'college_description' => 'nullable|string',
            'college_location' => 'nullable|string|max:255',
        ]);

        $college->update([
            'college_name' => $request->college_name,
            'college_code' => $request->college_code,
            'college_description' => $request->college_description,
            'college_location' => $request->college_location,
        ]);

        return redirect()->route('admin.colleges')->with('success', 'تم تحديث بيانات الكلية بنجاح');
    }

    // حذف كلية
    public function destroy(College $college)
    {
        $college->delete();
        return redirect()->route('admin.colleges')->with('success', 'تم حذف الكلية بنجاح');
    }

}