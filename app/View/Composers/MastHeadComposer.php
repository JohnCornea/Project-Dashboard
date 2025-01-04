<?php

namespace App\View\Composers;

use Illuminate\View\View;

class MastHeadComposer {

    public function compose(View $view)
    {
        $mastHeadPhoto = null;

        if(request()->routeIs('home'))
        {
            $mastHeadPhoto = 'images/home-bg.jpg';
        }

        if(request()->routeIs('home.about'))
        {
            $mastHeadPhoto = 'images/about-bg.jpg';
        }

        if(request()->routeIs('home.contact'))
        {
            $mastHeadPhoto = 'images/contact-bg.jpg';
        }

        $view->with('mastHeadPhoto', $mastHeadPhoto);
    }
}