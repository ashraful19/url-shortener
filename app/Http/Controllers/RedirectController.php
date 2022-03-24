<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    public function process($code)
    {
        $record = Url::where('short_code', $code)->first();
        if($record)
        {
            $record->increment('visits');
            return Redirect::away($record->long_url, 301);
        }
        else
        {
            return Redirect::to('404');
        }
    }
}
