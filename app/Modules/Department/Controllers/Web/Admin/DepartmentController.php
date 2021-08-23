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
    private $departmentService;

    /**
     * DepartmentController constructor.department.php
     * @param DepartmentService $departmentService
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * @return Application|Factory|View
     */
    public function department()
    {
        $data['base'] = 'department';
        $data['menu'] = 'department';
        $data['user'] = Auth::user();
        $data['department'] = $this->departmentService->department();
        $data['typeCount'] = $this->departmentService->typeCount();
        $data['categoryCount'] = $this->departmentService->categoryCount();
        $data['productCount'] = $this->departmentService->productCount();
        $data['productVariationCount'] = $this->departmentService->productVariationCount();
        $data['saleRecordCount'] = $this->departmentService->saleRecordCount();

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
        return $this->departmentService->saleRecordListQuery();
    }
}
