<?php

namespace App\Modules\Department\Controllers\Web\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Modules\Department\Requests\StoreDepartmentRequest;
use App\Modules\Department\Requests\UpdateDepartmentRequest;
use App\Modules\Department\Services\DepartmentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
        $data['base'] = 'dashboard';
        $data['menu'] = 'department';
        $data['user'] = Auth::user();
        $data['freshAdmins'] = $this->departmentService->freshAdmins();

        return view('super_admin.department.content', $data);
    }

    /**
     * @return mixed
     */
    public function departmentList()
    {
        return $this->departmentService->departmentListQuery();
    }

    /**
     * @param $encryptedDepartmentId
     * @return Application|Factory|View
     */
    public function details($encryptedDepartmentId)
    {
        $data['base'] = 'dashboard';
        $data['menu'] = 'department';
        $data['user'] = Auth::user();
        $data['departmentDetail'] = $this->departmentService->details($encryptedDepartmentId);
        $data['freshAdmins'] = $this->departmentService->freshAdmins();

        return view('super_admin.department.details', $data);
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreDepartmentRequest $request)
    {
        $response = $this->departmentService->store($request);

        return redirect(route('superAdmin.department.details', encrypt($response['data']['id'])))->with($response['webResponse']);
    }

    /**
     * @param UpdateDepartmentRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateDepartmentRequest $request)
    {
        $response = $this->departmentService->update($request);

        return redirect(route('superAdmin.department.details', encrypt($response['data']['id'])))->with($response['webResponse']);
    }

    /**
     * @param $encryptedDepartmentId
     * @return Application|RedirectResponse|Redirector
     */
    public function activate($encryptedDepartmentId)
    {
        $response = $this->departmentService->activate($encryptedDepartmentId);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedDepartmentId
     * @return Application|RedirectResponse|Redirector
     */
    public function deactivate($encryptedDepartmentId)
    {
        $response = $this->departmentService->deactivate($encryptedDepartmentId);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedDepartmentId
     * @return Application|RedirectResponse|Redirector
     */
    public function paymentDone($encryptedDepartmentId)
    {
        $response = $this->departmentService->paymentDone($encryptedDepartmentId);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedDepartmentId
     * @return array|JsonResponse|mixed
     */
    public function saleRecordList($encryptedDepartmentId)
    {
        return $this->departmentService->specificSaleRecordListQuery($encryptedDepartmentId);
    }

    /**
     * @param $encryptedDepartmentId
     * @return array|JsonResponse|mixed
     */
    public function productVariationList($encryptedDepartmentId)
    {
        return $this->departmentService->specificProductVariationListQuery($encryptedDepartmentId);
    }
}
