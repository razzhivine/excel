<?php

namespace App\Console\Commands;

use App\Imports\PlaceImport;
use App\Models\Task;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class PlaceImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:place-import-command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new PlaceImport(Task::find(1)), 'files/places.xlsx', 'public');
        return Command::SUCCESS;
    }
}
