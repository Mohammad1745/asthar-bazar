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
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * @return Application|Factory|RedirectResponse|View
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
        return $this->orderService->allOrderListQuery();
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
        $data['order'] = $this->orderService->order($encryptedOrderId);
        $data['orderDetails'] = $this->orderService->orderDetails($encryptedOrderId);
        $data['orderPayments'] = $this->orderService->orderPayments($encryptedOrderId);
        $data['orderCharges'] = $this->orderService->orderCharges($encryptedOrderId);

        return view('admin.order.details', $data);
    }

    /**
     * @param StoreChargeRequest $request
     * @return RedirectResponse
     */
    public function storeCharge(StoreChargeRequest $request)
    {
        $response = $this->orderService->storeCharge($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedOrderId
     * @return RedirectResponse
     */
    public function donePayment($encryptedOrderId)
    {
        $response = $this->orderService->makePaymentDone($encryptedOrderId);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedOrderId
     * @return RedirectResponse
     */
    public function completeOrder($encryptedOrderId)
    {
        $response = $this->orderService->makeOrderComplete($encryptedOrderId);

        return redirect()->back()->with($response['webResponse']);
    }
}
