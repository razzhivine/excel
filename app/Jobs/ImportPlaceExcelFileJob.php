<?php

namespace App\Jobs;

use App\Imports\PlaceImport;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportPlaceExcelFileJob implements ShouldQueue
{
    use Queueable;

    private $path;
    private Task $task;

    /**
     * Create a new job instance.
     * @param $path
     * @param $task
     */
    public function __construct($path, $task)
    {
        //
        $this->path = $path;
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->task->update(['status' => Task::STATUS_SUCCESS]);
        $this->import();
    }

    public function import()
    {
        Excel::import(new PlaceImport($this->task), $this->path, 'public');
        Storage::disk('public')->delete($this->path);
    }
}
