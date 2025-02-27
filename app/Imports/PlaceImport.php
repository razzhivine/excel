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
            $placesArray['items'][$key] = $projectFactory->getValues();
        }
        $json = json_encode($placesArray);

//        dump($json);
//        Storage::disk('public')->put("places-{$this->task->id}.json", $json);

        $curl = curl_init('https://guide.place/api/cppages');
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ( $status != 201 ) die("{$json_response} <br>") ;
        curl_close($curl);
        return json_decode($json_response, true);
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
