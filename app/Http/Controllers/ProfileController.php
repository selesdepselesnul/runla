<?php

/**
 * @author : Moch Deden
 * @site   : http://selesdepselesnul.com
 */

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function showProfile($npm)
    {
        return view(
            'profile.show', 
            ['npm' => $npm]
        );
    }
}