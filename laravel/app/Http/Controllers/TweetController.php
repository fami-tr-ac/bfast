<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function postTweet(Request $request)
    {
       $request->validate([
         'tweet' => 'required|max:140',
       ]);
    }
}
