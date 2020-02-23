<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Service\Router\RouterService;

class HomeController extends Controller
{
    public function home()
    {
        $host = $_SERVER['HTTP_HOST'];

        if($host === 'cv4d.samacom.com.vn'){
            return view('4d.index');
        }
        if($host === 'docvikhachhang.samacom.com.vn'){
            return view('tamly.tamly');
        }

        return view('home.index');
    }
}