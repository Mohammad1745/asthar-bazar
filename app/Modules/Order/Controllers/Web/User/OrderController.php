<?php

namespace App\Modules\Order\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Modules\Order\Requests\PlaceOrderRequestRequest;
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
        $data['base'] = 'account';
        $data['menu'] = 'order';
        $data['user'] = Auth::user();
        $data['orders'] = $this->service->orders();

        return view('user.order.content', $data);
    }

    /**
     * @return mixed
     */
    public function orderList()
    {
        return $this->service->orderListQuery();
    }

    /**
     * @param PlaceOrderRequestRequest $request
     * @return RedirectResponse
     */
    public function placeOrder(PlaceOrderRequestRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->placeOrder($request), 'order');
    }

    /**
     * @param string $encryptedOrderId
     * @return Application|Factory|View
     */
    public function orderDetails(string $encryptedOrderId)
    {
        $data['base'] = 'account';
        $data['menu'] = 'order';
        $data['user'] = Auth::user();
        $data['order'] = $this->service->order($encryptedOrderId);
        $data['orderDetails'] = $this->service->orderDetails($encryptedOrderId);
        $data['orderPayments'] = $this->service->orderPayments($encryptedOrderId);
        $data['orderCharges'] = $this->service->orderCharges($encryptedOrderId);

        return view('user.order.details', $data);
    }
}
