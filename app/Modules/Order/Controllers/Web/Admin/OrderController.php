<?php

namespace App\Modules\Order\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Order\Requests\PlaceOrderRequestRequest;
use App\Modules\Order\Requests\StoreChargeRequest;
use App\Modules\Order\Services\OrderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    private $service;

    /**
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }
    /**
     * @return Application|Factory|View
     */
    public function order()
    {
        $data['base'] = 'department';
        $data['menu'] = 'order';
        $data['user'] = Auth::user();

        return view('admin.order.content', $data);
    }

    /**
     * @return mixed
     */
    public function orderList()
    {
        return $this->service->allOrderListQuery();
    }

    /**
     * @param $encryptedOrderId
     * @return Application|Factory|View
     */
    public function orderDetails($encryptedOrderId)
    {
        $data['base'] = 'department';
        $data['menu'] = 'order';
        $data['user'] = Auth::user();
        $data['order'] = $this->service->order($encryptedOrderId);
        $data['orderDetails'] = $this->service->orderDetails($encryptedOrderId);
        $data['orderPayments'] = $this->service->orderPayments($encryptedOrderId);
        $data['orderCharges'] = $this->service->orderCharges($encryptedOrderId);

        return view('admin.order.details', $data);
    }

    /**
     * @param StoreChargeRequest $request
     * @return RedirectResponse
     */
    public function storeCharge(StoreChargeRequest $request): RedirectResponse
    {
        return $this->webResponse($this->service->storeCharge($request));
    }

    /**
     * @param string $encryptedOrderId
     * @return RedirectResponse
     */
    public function donePayment(string $encryptedOrderId): RedirectResponse
    {
        return $this->webResponse($this->service->makePaymentDone($encryptedOrderId));
    }

    /**
     * @param string $encryptedOrderId
     * @return RedirectResponse
     */
    public function completeOrder(string $encryptedOrderId): RedirectResponse
    {
        return $this->webResponse($this->service->makeOrderComplete($encryptedOrderId));
    }
}
