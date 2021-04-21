<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * App\Models\Counters
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Counters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Counters newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Counters query()
 * @mixin \Eloquent
 */
class Counters extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'user_id', // Пользователь, к которому привязаны счётчики
        'serial', // Серийный номер
        'installation_date', // Дата установки
        'end_of_service_date', // Дата окончания эксплуатации
        'number_in_social_garanty', // Номер счётчика в квитанциях соц.гарантий
        'verification_date', // Дата поверки, но не съёма
        'verification_period', // Через сколько лет поверка
        'affiliation', // Тип счётчика. Хв, Гв, ЭП и т.д.
        'description', // Подпись, где стоит. Кухня/ванна/щиток
        'replacement_made', // Замена выполнена? Да/нет. Флаг, для переноса счётчика в другую таблицу
        // при замене
    ];

    /**
     * Выдаём список актуальных счётчиков, которые привязаны к авторизованному пользователю
     */
    public function countersOfThisUser()
    {
        return static::whereUser_id(auth()->id())
            ->whereReplacement_made('0')
            ->get();
    }

    /**
     * Проверяем подходил ли срок поверки счётчика/счётчиков
     */
    public function verificationDateCome()
    {
        return static::whereUser_id(auth()->id())
        ->where('verification_date', '>=', now())
        ->where('verification_date', '<=', now()->addMonths(3))
        ->whereReplacement_made('0')
        ->get();
    }

    /**
     * Проверяем подходит ли срок замены счётчика/счётчиков
     */
    public function endOfServiceDateCome()
    {
        return static::whereUser_id(auth()->id())
        ->where('end_of_service_date', '>=', now())
        ->where('end_of_service_date', '<=', now()->addMonths(3))
        ->whereReplacement_made('0')
        ->get();
    }

    /**
     * Выдаём список архивных счётчиков пользователя
     */
    public function archiveCountersOfThisUser()
    {
        return static::whereUser_id(auth()->id())
            ->whereReplacement_made('1')
            ->get();
    }

    /**
     * Список узлов, где могут стоять счётчики
     */
    public function locationOfCounters()
    {
        return static::whereUser_id(auth()->id())
            ->groupBy('description')
            ->get();
    }

    /**
     * Типы счётчиков
     */
    public function typeOfCounters()
    {
        return static::whereUser_id(auth()->id())
            ->groupBy('affiliation')
            ->get();
    }

    /**
     * Валидация формы замены счётчика
     */
    public function validateChangeCounter()
    {
        return 
        [
            'old_serial' => ['required', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'affiliation' => ['required', 'string', 'max:255'],
            'serial' => ['required', 'string', 'max:255'],
            'number_in_social_garanty' => ['required', 'integer'],
            'installation_date' => ['required', 'date'],
            'verification_period' => ['required', 'integer', 'max:10'],
        ];
    }

    /**
     * Добавление нового счётчика
     * Этот же метод используется для редактирования счётчиков
     */
    public function addNewCounter($request)
    {
        // Если меняем счётчик, то старый переводим в архив
        if($request->old_serial)
        {
            // Старому счётчику меняем статус 'замены' на единичку
            static::find($request->old_serial)->update(['replacement_made' => '1']);
        }

        /**
         * На основании даты установки и периода эксплуатации высчитываем даты поверки и дату
         * окончания эксплуатации
         */
        $instalDate = Carbon::parse($request->installation_date);
        $period = (int)$request->verification_period;
        $verificationDate = $instalDate->copy()->addYear($period)->format('Y-m-d');
        $endOfServiceDate = $instalDate->copy()->addYear($period * 2)->format('Y-m-d');
    
        // Возвращаем подготовленные данные для заполнения БД
        return [
            'user_id' => auth()->id(),
            'serial' => $request->serial,
            'installation_date' => $request->installation_date,
            'end_of_service_date' => $endOfServiceDate,
            'number_in_social_garanty' => $request->number_in_social_garanty,
            'verification_date' => $verificationDate,
            'verification_period' => $period,
            'affiliation' => $request->affiliation,
            'description' => $request->description,
        ];
    }

}
