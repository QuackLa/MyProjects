<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indications extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'indications',
        'month',
        'year',
        'counter_id',
        'user_id',
    ];

    /**
     * Месяцы
     * @var array
     */
    protected $months = [
        'Январь', 
        'Февраль', 
        'Март', 
        'Апрель', 
        'Май', 
        'Июнь', 
        'Июль', 
        'Август', 
        'Сентябрь', 
        'Октябрь', 
        'Ноябрь', 
        'Декабрь',
    ];

    /**
     * Годы
     * @var array
     */
    protected $years = [];


    /**
     * Правила валидации для страницы добавления показаний счётчика
     * http://php/testProject/public/add
     */
    public function validateRules()
    {
        return 
        [
            'indications' => ['required', 'integer', 'max:255'],
            'month' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
            'counter_id' => ['required', 'integer', 'max:255'],
            'user_id' => ['required'],
        ];
    }

    /**
     * Связь с моделью Users, чтобы извлекать данные по id
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Связь с моделью Counters, чтобы извлекать данные по id
     */
    public function counters()
    {
        return $this->belongsTo(Counters::class, 'counter_id');
    }

    /**
     * Возвращаем список месяцев
     */
    public function listOfMonths()
    {
        return $this->months;
    }

    /**
     * Возвращаем список лет с 2021 по 2100 годы
     */
    public function listOfYears()
    {
        // Чтобы эта функция всегда предлагала актуальный список, просто прибавляем к текущему году 10 лет.
        $date = now()->addYears(11)->format('Y');

        for($i = 2021; $i < $date; $i++)
        {
            $this->years[] = $i;
        }

        return $this->years;
    }

    /**
     * Выдаём показания счётчиков по запросу, с указанием месяца, года, и id счётчика. Юзера берём
     * из сессии
     */
    public function showIndi($request)
    {
        return static::whereUser_id(auth()->id())
            ->where('month', $request->selectedMonth)
            ->where('year', $request->selectedYear)
            ->with(['users', 'counters'])
            ->get();
    }

    /**
     * Редактируем показания счётчиков в БД
     */
    public function editIndi($request)
    {
        return static::whereUser_id(auth()->id())
        ->where('month', $request->month)
        ->where('year', $request->year)
        ->whereCounter_id($request->counter_id)
        ->update(['indications' => $request->indications]);
    }

    /**
     * Удаление показаний
     */
    public function deleteIndi()
    {
        //
    }
}
