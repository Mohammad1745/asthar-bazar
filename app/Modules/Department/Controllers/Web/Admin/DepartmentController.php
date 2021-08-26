<?php

namespace App\Modules\Department\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Department\Services\DepartmentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    private $service;

    /**
     * DepartmentController constructor.department.php
     * @param DepartmentService $service
     */
    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function department()
    {
        $data['base'] = 'department';
        $data['menu'] = 'department';
        $data['user'] = Auth::user();
        $data['department'] = $this->service->department();
        $data['typeCount'] = $this->service->typeCount();
        $data['categoryCount'] = $this->service->categoryCount();
        $data['productCount'] = $this->service->productCount();
        $data['productVariationCount'] = $this->service->productVariationCount();
        $data['saleRecordCount'] = $this->service->saleRecordCount();

        return view('admin.department.content', $data);
    }
    public function saleRecord()
    {
        $data['base'] = 'department';
        $data['menu'] = 'sale_record';
        $data['user'] = Auth::user();

        return view('admin.department.sale_record', $data);
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function saleRecordList()
    {
        return $this->service->saleRecordListQuery();
    }
}
