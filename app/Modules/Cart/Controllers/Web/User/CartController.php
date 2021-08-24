<?php

namespace App\Modules\Cart\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Modules\Cart\Requests\UpdateCartRequest;
use App\Modules\Cart\Services\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    private $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function cart()
    {
        $data['base'] = 'home';
        $data['menu'] = 'cart';
        $data['user'] = Auth::user();
        $response = $this->service->cart();
        if($response['success']){
            $data['cart'] = $response['data'];
            $data['cartDetails'] = $this->service->cartDetails($response['data']);

            return view('user.cart.content', $data);
        }else{
            return redirect()->back()->with($response['webResponse']);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function clear(): RedirectResponse
    {
        return $this->webResponse( $this->service->clearCart());
    }

    /**
     * @param $encryptedProductVariationId
     * @return RedirectResponse
     */
    public function addProductVariation($encryptedProductVariationId): RedirectResponse
    {
        return $this->webResponse( $this->service->addProductVariation($encryptedProductVariationId));
    }

    /**
     * @param UpdateCartRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateCartRequest $request): RedirectResponse
    {
        return $this->webResponse( $this->service->updateCart($request));
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function checkout()
    {
        $data['base'] = 'home';
        $data['menu'] = 'cart';
        $data['user'] = Auth::user();
        $response = $this->service->cart();
        if($response['success']&&$response['data']['quantity']>0){
            return view('user.cart.checkout', $data);
        }else{
            return redirect()->back()->with('error', 'Empty Cart');
        }
    }
}
