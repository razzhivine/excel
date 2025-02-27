<?php

namespace App\Http\Controllers;

use App\Http\Requests\Place\StoreRequest;
use App\Jobs\ImportPlaceExcelFileJob;
use App\Models\File;
use App\Models\Place;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['link'] = Storage::disk('public')->url('files/storage.txt');
        return inertia('Place/Index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $file = File::putAndCreate($data['file']);

        $task = Task::create([
            'file_id' => $file->id,
            'user_id' => auth()->id(),
        ]);

        ImportPlaceExcelFileJob::dispatchSync($file->path, $task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        //
    }
}
