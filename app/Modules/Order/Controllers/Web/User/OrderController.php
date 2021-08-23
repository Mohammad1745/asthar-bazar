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
        $data['base'] = 'account';
        $data['menu'] = 'order';
        $data['user'] = Auth::user();
        $data['orders'] = $this->orderService->orders();

        return view('user.order.content', $data);
    }

    /**
     * @return mixed
     */
    public function orderList()
    {
        return $this->orderService->orderListQuery();
    }

    /**
     * @param PlaceOrderRequestRequest $request
     * @return RedirectResponse
     */
    public function placeOrder(PlaceOrderRequestRequest $request)
    {
        $response = $this->orderService->placeOrder($request);

        return $response['success'] ?
            redirect(route('order'))->with($response['webResponse']):
            redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedOrderId
     * @return Application|Factory|View
     */
    public function orderDetails($encryptedOrderId)
    {
        $data['base'] = 'account';
        $data['menu'] = 'order';
        $data['user'] = Auth::user();
        $data['order'] = $this->orderService->order($encryptedOrderId);
        $data['orderDetails'] = $this->orderService->orderDetails($encryptedOrderId);
        $data['orderPayments'] = $this->orderService->orderPayments($encryptedOrderId);
        $data['orderCharges'] = $this->orderService->orderCharges($encryptedOrderId);

        return view('user.order.details', $data);
    }
}
