<?php

namespace controllers;

use Controller;

class Lots extends Controller
{
    protected object $lotModel;

    public function __construct()
    {
        $this->lotModel = $this->model('Lot');
    }
}