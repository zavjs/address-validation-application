<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Address Validation App";

        return view('partials/header', $data)
        . view('home')
        . view('partials/footer');
    }
}
