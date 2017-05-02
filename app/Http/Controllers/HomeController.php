<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	$response = \Mailgun::send('emails.index', [], function ($message) {
    		$message->to('abu2602@gmail.com', 'John Smith')->subject('Welcome!')->attach('index.php')->tag('testing');
		});
    }
}
