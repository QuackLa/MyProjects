<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankDetailsController extends Controller
{
    /**
     * Контроллер отвечает за работу с разделом 'Как оплатить?'
     */
    
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Как оплачивать?
     */
    public function howToPay()
    {
        return view('howToPay', [
            'contactsDetail' => $this->account_numbers->bankDetail(),
        ]);
    }
}
