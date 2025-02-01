<?php

namespace App\Imports;

use App\Factory\PlaceFactory;
use App\Models\FailedRow;
use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class PlaceImport implements ToCollection, withHeadingRow, WithValidation, SkipsOnFailure
{
    private Task $task;

    /**
     * @param $task
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $placesArray = [];
        foreach ($collection as $key => $row) {
            $projectFactory = PlaceFactory::make($row);
            $placesArray[$key] = $projectFactory->getValues();
        }
        Storage::disk('public')->put("places-{$this->task->id}.json", json_encode($placesArray));
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'roditelskaia_stranica' => 'required|integer',
            'maket' => 'required|integer',
            'zagolovok' => 'required|string',
            'tekst' => 'nullable|string',
            'alias' => 'required|string',
            'koordinaty' => 'nullable|string',
            'kategoriia_obieekta' => 'nullable|integer',
            'izobrazenie' => 'nullable|string',
            'galereia' => 'nullable|string',
            'adres' => 'nullable|string',
            'tegi' => 'nullable|string',
            'filtry' => 'nullable|string',
            'rekomendaciia' => 'nullable|string',
            'dlitelnost_iventa_casy' => 'nullable|integer',
            'zagolovok_okna' => 'nullable|string',
            'keywords' => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $map = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $error) {
                $map[] = [
                    'key' => $this->attributesMap()[$failure->attribute()],
                    'row' => $failure->row(),
                    'message' => $error,
                    'task_id' => $this->task->id
                ];
            }
        }
        if (!empty($map)) FailedRow::insertFailedRows($map, $this->task);
    }

    private function attributesMap(): array
    {
        return [
            'id' => 'id',
            'roditelskaia_stranica' => 'Родительская страница',
            'maket' => 'Макет',
            'zagolovok' => 'Заголовок',
            'tekst' => 'Текст',
            'alias' => 'Алиас',
            'koordinaty' => 'Координаты',
            'kategoriia_obieekta' => 'Категория объекта',
            'izobrazenie' => 'Изображение',
            'galereia' => 'Галерея',
            'adres' => 'Адрес',
            'tegi' => 'Теги',
            'filtry' => 'Фильтры',
            'rekomendaciia' => 'Рекомендация',
            'dlitelnost_iventa_casy' => 'Длительность ивента (часы)',
            'zagolovok_okna' => 'Заголовок окна',
            'keywords' => 'Keywords',
            'description' => 'Description',
        ];
    }
}
