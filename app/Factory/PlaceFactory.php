<?php

namespace App\Factory;

use App\Models\Type;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PlaceFactory
{
    private $id;
    private $parent_page_id;
    private $layout_id;
    private $field_header;
    private $field_content;
    private $alias;
    private $field_coords;
    private $field_object_category_id;
    private $field_image;
    private $field_gallery;
    private $field_address;
    private $field_tags;
    private $field_filters;
    private $field_recommendations;
    private $field_event_duration;
    private $title;
    private $keywords;
    private $description;

    public function __construct($id, $parent_page_id, $layout_id, $field_header, $field_content, $alias, $field_coords, $field_object_category_id, $field_image, $field_gallery, $field_address, $field_tags, $field_filters, $field_recommendations, $field_event_duration, $title, $keywords, $description)
    {
        $this->id = $id;
        $this->parent_page_id = $parent_page_id;
        $this->layout_id = $layout_id;
        $this->field_header = $field_header;
        $this->field_content = $field_content;
        $this->alias = $alias;
        $this->field_coords = $field_coords;
        $this->field_object_category_id = $field_object_category_id;
        $this->field_image = $field_image;
        $this->field_gallery = $field_gallery;
        $this->field_address = $field_address;
        $this->field_tags = $field_tags;
        $this->field_filters = $field_filters;
        $this->field_recommendations = $field_recommendations;
        $this->field_event_duration = $field_event_duration;
        $this->title = $title;
        $this->keywords = $keywords;
        $this->description = $description;
    }


    /**
     * @return mixed
     */
    public static function make($row)
    {
        return new self(
            $row['id'],
            $row['roditelskaia_stranica'],
            $row['maket'],
            $row['zagolovok'],
            $row['tekst'],
            $row['alias'],
            $row['koordinaty'],
            $row['kategoriia_obieekta'],
            $row['izobrazenie'],
            $row['galereia'],
            $row['adres'],
            $row['tegi'],
            $row['filtry'],
            $row['rekomendaciia'],
            $row['dlitelnost_iventa_casy'],
            $row['zagolovok_okna'],
            $row['keywords'],
            $row['description'],
        );
    }

    public function getValues(): array
    {
        $props = get_object_vars($this);
        $res = [];
        foreach ($props as $prop => $value) {
            $res[Str::snake($prop)] = $value;
        }
        return $res;
    }
}
