<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    * Модели помещаем в свойства класса-родителя
    */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Главная страница
     */
    public function welcomeHome()
    {
        return view('welcome',[
            'months' => $this->indi->listOfMonths(),
            'years' => $this->indi->listOfYears(),
            'counters' => $this->counters->countersOfThisUser(),
            'contacts' => $this->contacts->userContacts(),
            'verificationDateCome' => $this->counters->verificationDateCome(),
            'endOfServiceDateCome' => $this->counters->endOfServiceDateCome(),
        ]);
    }
}
