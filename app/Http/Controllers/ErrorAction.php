<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use Illuminate\Http\Request;

class ErrorAction extends Controller
{
    public function index()
    {
        throw new AppException('errors.page', 'error.');
    }
}
