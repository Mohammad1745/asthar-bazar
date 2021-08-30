<?php

namespace App\Modules\Home\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Modules\Home\Services\HomeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    private $service;

    /**
     * HomeController constructor.
     * @param HomeService $service
     */
    public function __construct(HomeService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function home()
    {
        $data['base'] = 'home';
        $data['menu'] = 'home';
        $data['user'] = Auth::user();
        $data['sliderImage'] = asset('assets/images/home_slider_1.jpg');
        $data['productVariations'] = $this->service->randomProductVariations();
        $data['maxDiscount'] = $this->service->maxDiscount();

        return view('user.home.content', $data);
    }
}
