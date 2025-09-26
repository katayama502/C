<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreWorkRequest;
use App\Http\Requests\Student\UpdateWorkRequest;
use App\Models\Work;
use App\Notifications\NewWorkNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    public function index()
    {
        $works = Auth::user()->student->works()->latest()->paginate();
        return view('student.works.index', compact('works'));
    }

    public function create()
    {
        return view('student.works.create');
    }

    public function store(StoreWorkRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('works', 'public');
        }

        $work = Auth::user()->student->works()->create($data);

        $parents = Auth::user()->student->parents()->with('user')->get();
        Notification::send($parents, new NewWorkNotification($work));

        return redirect()->route('student.works.index')->with('status', __('作品を投稿しました。'));
    }

    public function edit(Work $work)
    {
        $this->authorize('update', $work);
        return view('student.works.edit', compact('work'));
    }

    public function update(UpdateWorkRequest $request, Work $work)
    {
        $this->authorize('update', $work);

        $data = $request->validated();
        if ($request->hasFile('file')) {
            if ($work->file_path) {
                Storage::disk('public')->delete($work->file_path);
            }
            $data['file_path'] = $request->file('file')->store('works', 'public');
        }

        $work->update($data);

        return redirect()->route('student.works.index')->with('status', __('作品を更新しました。'));
    }

    public function destroy(Work $work)
    {
        $this->authorize('delete', $work);
        if ($work->file_path) {
            Storage::disk('public')->delete($work->file_path);
        }
        $work->delete();

        return redirect()->route('student.works.index')->with('status', __('作品を削除しました。'));
    }
}
