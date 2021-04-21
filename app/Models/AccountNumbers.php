<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountNumbers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contacts_id',
        'account_number',
        'description',
    ];

    
    /**
     * Связь с моделью Contacts, чтобы извлекать данные по id
     */
    public function contacts()
    {
        return $this->belongsTo(Contacts::class, 'contacts_id');
    }

    /**
     * Выборка счетов и контактов по пользователю
     */
    public function bankDetail()
    {
        return static::whereUser_id(auth()->id())
            ->with(['contacts'])
            ->get();
    }
}
