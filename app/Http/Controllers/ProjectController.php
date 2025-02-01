<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Jobs\ImportProjectExcelFileJob;
use App\Models\File;
use App\Models\Project;
use App\Models\Task;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);
        $projects = ProjectResource::collection($projects);
        return inertia('Project/Index', compact('projects'));
    }

    public function import()
    {
        return inertia('Project/Import');
    }

    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $file = File::putAndCreate($data['file']);

        $task = Task::create([
            'file_id' => $file->id,
            'user_id' => auth()->id(),
        ]);

        ImportProjectExcelFileJob::dispatchSync($file->path, $task);
    }
}
