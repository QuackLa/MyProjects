<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'district',
        'title',
        'phone',
        'email',
        'website',
        'address',
    ];

    /**
     * Получаем контакты по городу и району
     */
    public function userContacts()
    {
        return static::whereCity(auth()->user()->city)
            ->whereDistrict(auth()->user()->district)
            ->get();
    }

    /**
     * Добавление контакта
     */
    public function addContact($request)
    {
        return [
            'city' => auth()->user()->city,
            'district' => auth()->user()->district,
            'title' => $request->title,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'address' => $request->address,
        ];
    }

    /**
     * Редактирование контакта
     */
    public function editContact($request)
    {
        return [
            'city' => auth()->user()->city,
            'district' => auth()->user()->district,
            'title' => $request->title,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'address' => $request->address,
        ];
    }
}
