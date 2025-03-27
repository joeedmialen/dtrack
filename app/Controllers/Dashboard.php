<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $data = ['testData' => "hello world",'active_tab'=>'Dashboard'];
        return view('dashboard', $data);
    }
}
