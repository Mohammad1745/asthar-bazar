<?php

namespace App\Modules\Dashboard\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Modules\Dashboard\Services\DashboardService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function dashboard()
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'dashboard';
        $data['user'] = Auth::user();

        return view('super_admin.dashboard.content', $data);
    }
}
