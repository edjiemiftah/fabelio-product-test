<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function save(Request $request)
    {
        $url = $request->input('q');
        $html = file_get_contents($url);
        echo $html;
        // var_dump($request);
        // exit();
    }
}