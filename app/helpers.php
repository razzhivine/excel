<?php

use App\Models\FailedRow;

if(!function_exists('processFailures')){
    function processFailures($failures, $attributeMap, $task)
    {
        $map = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $error) {
                $map[] = [
                    'key' => $attributeMap[$failure->attribute()],
                    'row' => $failure->row(),
                    'message' => $error,
                    'task_id' => $task->id
                ];
            }
        }

        if (!empty($map)) FailedRow::insertFailedRows($map, $task);
    }
}
