<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreGrowthRecordRequest;
use App\Http\Requests\Student\UpdateGrowthRecordRequest;
use App\Models\GrowthRecord;
use App\Notifications\NewGrowthRecordNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class GrowthRecordController extends Controller
{
    public function index()
    {
        $records = Auth::user()->student->growthRecords()->latest()->paginate();
        return view('student.growth-records.index', compact('records'));
    }

    public function create()
    {
        return view('student.growth-records.create');
    }

    public function store(StoreGrowthRecordRequest $request)
    {
        $record = Auth::user()->student->growthRecords()->create($request->validated());

        $parents = Auth::user()->student->parents()->with('user')->get();
        Notification::send($parents, new NewGrowthRecordNotification($record));

        return redirect()->route('student.growth-records.index')->with('status', __('学習記録を保存しました。'));
    }

    public function edit(GrowthRecord $growthRecord)
    {
        $this->authorize('update', $growthRecord);
        return view('student.growth-records.edit', compact('growthRecord'));
    }

    public function update(UpdateGrowthRecordRequest $request, GrowthRecord $growthRecord)
    {
        $this->authorize('update', $growthRecord);
        $growthRecord->update($request->validated());

        return redirect()->route('student.growth-records.index')->with('status', __('学習記録を更新しました。'));
    }

    public function destroy(GrowthRecord $growthRecord)
    {
        $this->authorize('delete', $growthRecord);
        $growthRecord->delete();

        return redirect()->route('student.growth-records.index')->with('status', __('学習記録を削除しました。'));
    }
}
