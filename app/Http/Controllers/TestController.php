<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function __call($method, $parameters)
    {
        parent::__call($method, $parameters);
    }

}
