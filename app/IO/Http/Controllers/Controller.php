<?php

namespace App\IO\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Health check
     * @return string
     */
    public function index()
    {
        return 'OK';
    }
}
