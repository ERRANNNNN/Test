<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

class ArrayController extends Controller
{
    private array $array = [
        ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
        ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
        ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
        ['id' => 1, 'date' => "22.01.2020", 'name' => "test1"],
        ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
        ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"]
    ];

    /**
     * Первый вариант выборки уникальных значений
     * @return void
     */
    public function getUnique(): void
    {
        $collection = new Collection($this->array);
        $uniqueArray = $collection->unique('id')->toArray();
        dd($uniqueArray);
    }

    /**
     * Второй вариант получения уникальных значений
     * @return void
     */
    public function getUnique_v2(): void
    {
        $uniqueArrayKeys = array_unique(array_column($this->array, 'id'));
        $uniqueArray = array_intersect_key($this->array, $uniqueArrayKeys);
        dd($uniqueArray);
    }

    /**
     * Сортировка по ключу v1
     * @return void
     */
    public function sort()
    {
        $collection = new Collection($this->array);
        $sortedArray = $collection->sortBy('id')->toArray();
        dd($sortedArray);
    }

    /**
     * Сортировка по ключу v2
     * @return void
     */
    public function sort_v2()
    {
        uasort($this->array, function ($x, $y) {
            return ($x['id'] > $y['id']);
        });
        dd($this->array);
    }

    /**
     * Поиск элементов по условию v1
     * (допустим все элементы где id > 2)
     * @return void
     */
    public function find()
    {
        $collection = new Collection($this->array);
        $resultArray = $collection->where('id', '>', 2)->toArray();
        dd($resultArray);
    }

    /**
     * Поиск элементов по условию v2
     * (допустим все элементы где id > 2)
     * @return void
     */
    public function find_v2()
    {
        $resultArray = array_filter($this->array, function ($value) {
            if ($value['id'] > 2) {
                return $value;
            }
        });
        dd($resultArray);
    }

    public function changeKeysValues()
    {
        $collection = new Collection($this->array);
        $ids = $collection->pluck('id')->toArray();
        $names = $collection->pluck('name')->toArray();
        $resultArray = array_combine($names, $ids);
        dd($resultArray);
    }

    public function changeKeysValues_v2()
    {
        $ids = array_column($this->array, 'id');
        $names = array_column($this->array, 'name');
        $resultArray = array_combine($names,$ids);
        dd($resultArray);
    }
}
