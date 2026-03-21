<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineApplication;
use App\Models\OnlineApplicationEntry;
use Illuminate\Http\Request;

class OnlineApplicationController extends Controller
{
    protected string $basePath = '';

    public function index()
    {
        $applications = OnlineApplication::withCount('entries')->latest()->paginate(15);

        return view('admin.online-applications.index', compact('applications'));
    }

    public function create()
    {
        return view('admin.online-applications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name' => ['required', 'string', 'max:255'],
            'registration_date' => ['nullable', 'date'],
            'education_start' => ['nullable', 'date'],
            'education_end' => ['nullable', 'date', 'after_or_equal:education_start'],
            'education_hours' => ['nullable', 'integer'],
            'fee' => ['nullable', 'integer'],
            'status' => ['nullable', 'string'],
            'max_participants' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
        ]);

        OnlineApplication::create($validated);

        return redirect($this->basePath . '/admin/online-applications')
            ->with('success', '온라인 신청이 등록되었습니다.');
    }

    public function show(OnlineApplication $onlineApplication)
    {
        return view('admin.online-applications.show', compact('onlineApplication'));
    }

    public function edit(OnlineApplication $onlineApplication)
    {
        $application = $onlineApplication;
        return view('admin.online-applications.edit', compact('application'));
    }

    public function update(Request $request, OnlineApplication $onlineApplication)
    {
        $validated = $request->validate([
            'course_name' => ['required', 'string', 'max:255'],
            'registration_date' => ['nullable', 'date'],
            'education_start' => ['nullable', 'date'],
            'education_end' => ['nullable', 'date', 'after_or_equal:education_start'],
            'education_hours' => ['nullable', 'integer'],
            'fee' => ['nullable', 'integer'],
            'status' => ['nullable', 'string'],
            'max_participants' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
        ]);

        $onlineApplication->update($validated);

        return redirect($this->basePath . '/admin/online-applications')
            ->with('success', '온라인 신청이 수정되었습니다.');
    }

    public function destroy(OnlineApplication $onlineApplication)
    {
        $onlineApplication->delete();

        return redirect($this->basePath . '/admin/online-applications')
            ->with('success', '온라인 신청이 삭제되었습니다.');
    }

    public function entries($id)
    {
        $application = OnlineApplication::findOrFail($id);
        $entries = $application->entries()->latest()->paginate(20);

        return view('admin.online-applications.entries', compact('application', 'entries'));
    }

    public function storeEntry(Request $request, $id)
    {
        $application = OnlineApplication::findOrFail($id);

        $validated = $request->validate([
            'applicant_name' => ['required', 'string', 'max:100'],
            'applicant_email' => ['nullable', 'email', 'max:255'],
            'applicant_phone' => ['nullable', 'string', 'max:50'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'data' => ['nullable', 'array'],
        ]);

        $validated['online_application_id'] = $application->id;

        OnlineApplicationEntry::create($validated);

        return back()->with('success', '신청이 접수되었습니다.');
    }
}
