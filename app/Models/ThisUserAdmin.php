<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThisUserAdmin extends Model
{
    use HasFactory;

    /**
     * Проверка формы при добавлении контакта
     */
    public function addContactValidate()
    {
        return 
        [
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'title' => ['required', 'unique:contacts', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Проверка формы при добавлении счётчика
     */
    public function addCounterValidate()
    {
        return 
        [
            'description' => ['required', 'string', 'max:255'],
            'affiliation' => ['required', 'string', 'max:255'],
            'serial' => ['required', 'string', 'max:255'],
            'number_in_social_garanty' => ['required', 'integer'],
            'installation_date' => ['required', 'date'],
            'verification_period' => ['required', 'integer', 'max:10'],
        ];
    }

    /**
     * Проверка формы редактирования контакта
     */
    public function editContactValidate()
    {
        return 
        [
            'title' => ['required', 'unique:contacts', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Проверка формы при изменении счётчика
     */
    public function editCounterValidate()
    {
        return 
        [
            'counter_id' => ['required', 'integer', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'affiliation' => ['required', 'string', 'max:255'],
            'serial' => ['required', 'string', 'max:255'],
            'number_in_social_garanty' => ['required', 'integer'],
            'installation_date' => ['required', 'date'],
            'verification_period' => ['required', 'integer', 'max:10'],
        ];
    }

    /**
     * Проверка формы при удалении счётчика
     */
    public function deleteCounterValidate()
    {
        return 
        [
            'counter_id' => ['required', 'integer', 'max:255'],
        ];
    }
}
