<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checks extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'month',
        'year',
        'filename',
    ];

    /**
     * Сохранение имени и расширения файлов в БД, согласно их же id
     */
    public function addCheck($request)
    {
        // Определяем расширение загружаемого файла
        $extension = $request->extension();
        /**
         * Смотрим, есть ли в БД записи о чеках. Если записи есть, составляем имя файла на основе
         * последнего id. Иначе называем его '1'
         */
        $lastId = static::latest('id')->first();

        if($lastId)
        {
            $lastId = $lastId->id + 1;
            return "$lastId.$extension";
        }
        else 
        {
            return "1.$extension";
        }
    }

    /**
     * Выбор информации о чеках из БД по месяцу, году и юзеру
     */
    public function findChecks($month, $year)
    {
        return static::whereUser_id(auth()->id())
            ->where('month', $month)
            ->where('year', $year)
            ->get();
    }

    /**
     * Проверка формы для добавления чеков
     */
    public function validateRules()
    {
        return 
        [
            'user_id' => ['required'],
            'month' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
            'checkPhoto' => ['required', 'file', 'max:51200'],
        ];
    }

    /**
     * Проверяем, был ли выбран файл для скачивания в разделе чеков
     */
    public function validFile()
    {
        return
        [
            'filename' => ['required'],
        ];
    }
}
