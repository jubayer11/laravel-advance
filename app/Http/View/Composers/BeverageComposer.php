<?php

namespace App\Http\View\Composers;

use App\Models\Bevarage;

use Illuminate\View\View;
use Illuminate\Support\Collection;

class BeverageComposer
{

    public function compose(View $view)
    {
        $view->with('beverages', Bevarage::orderBy('id')->get());


    }


}
