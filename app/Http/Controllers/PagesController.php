<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Crypt;

class PagesController extends Controller
{
    public function pages($id)
    {
        $id_page = Crypt::decrypt($id);

        $title = '';
        $url = '';
        switch($id_page){
            case 'login' : 
                $title = 'Login';
                $url = 'login'; break;
            case 'register' : 
                $title = 'Register';
                $url = 'register'; break;
            default :
                $title = '';
                $url = ''; break;
        }

        return view($url, compact('title'));
    }

    public function forbidden()
    {
        $title = 'Forbidden';
        return view('forbidden', compact('title'));
    }
}
