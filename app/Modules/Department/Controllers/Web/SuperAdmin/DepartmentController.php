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
        $data['base'] = 'dashboard';
        $data['menu'] = 'department';
        $data['user'] = Auth::user();
        $data['freshAdmins'] = $this->service->freshAdmins();

        return view('super_admin.department.content', $data);
    }

    /**
     * @return mixed
     */
    public function departmentList()
    {
        return $this->service->departmentListQuery();
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
        $data['departmentDetail'] = $this->service->details($encryptedDepartmentId);
        $data['freshAdmins'] = $this->service->freshAdmins();

        return view('super_admin.department.details', $data);
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreDepartmentRequest $request)
    {
        $response = $this->service->store($request);

        return redirect(route('superAdmin.department.details', encrypt($response['data']['id'])))->with($response['webResponse']);
    }

    /**
     * @param UpdateDepartmentRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateDepartmentRequest $request)
    {
        $response = $this->service->update($request);

        return redirect(route('superAdmin.department.details', encrypt($response['data']['id'])))->with($response['webResponse']);
    }

    /**
     * @param string $encryptedDepartmentId
     * @return RedirectResponse
     */
    public function activate(string $encryptedDepartmentId): RedirectResponse
    {
        return $this->webResponse($this->service->activate($encryptedDepartmentId));
    }

    /**
     * @param string $encryptedDepartmentId
     * @return RedirectResponse
     */
    public function deactivate(string $encryptedDepartmentId): RedirectResponse
    {
        return $this->webResponse($this->service->deactivate($encryptedDepartmentId));
    }

    /**
     * @param string $encryptedDepartmentId
     * @return RedirectResponse
     */
    public function paymentDone(string $encryptedDepartmentId): RedirectResponse
    {
        return $this->webResponse($this->service->paymentDone($encryptedDepartmentId));
    }

    /**
     * @param $encryptedDepartmentId
     * @return array|JsonResponse|mixed
     */
    public function saleRecordList($encryptedDepartmentId)
    {
        return $this->service->specificSaleRecordListQuery($encryptedDepartmentId);
    }

    /**
     * @param $encryptedDepartmentId
     * @return array|JsonResponse|mixed
     */
    public function productVariationList($encryptedDepartmentId)
    {
        return $this->service->specificProductVariationListQuery($encryptedDepartmentId);
    }
}
