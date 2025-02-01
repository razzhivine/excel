<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $guarded = false;


    public static function putAndCreate($dataFile)
    {
        $path = Storage::disk('public')->putFile('files/', $dataFile);
        return File::create([
            'title' => $dataFile->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $dataFile->getClientOriginalExtension(),
        ]);

    }
}
