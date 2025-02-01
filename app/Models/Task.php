<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = false;

    const STATUS_PROCESS = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_ERROR = 3;

    public static function getStatuses()
    {
        return [
            self::STATUS_PROCESS => 'in processing',
            self::STATUS_SUCCESS => 'success',
            self::STATUS_ERROR => 'error',
        ];
    }


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function file(){
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function failedRows(){
        return $this->hasMany(FailedRow::class, 'task_id', 'id');
    }
}
