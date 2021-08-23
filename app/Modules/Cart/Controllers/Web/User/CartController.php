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
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function cart()
    {
        $data['base'] = 'home';
        $data['menu'] = 'cart';
        $data['user'] = Auth::user();
        $response = $this->cartService->cart();
        if($response['success']){
            $data['cart'] = $response['data'];
            $data['cartDetails'] = $this->cartService->cartDetails($response['data']);

            return view('user.cart.content', $data);
        }else{
            return redirect()->back()->with($response['webResponse']);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function clear()
    {
        $response = $this->cartService->clearCart();

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param $encryptedProductVariationId
     * @return RedirectResponse
     */
    public function addProductVariation($encryptedProductVariationId)
    {
        $response = $this->cartService->addProductVariation($encryptedProductVariationId);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @param UpdateCartRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateCartRequest $request)
    {
        $response = $this->cartService->updateCart($request);

        return redirect()->back()->with($response['webResponse']);
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function checkout()
    {
        $data['base'] = 'home';
        $data['menu'] = 'cart';
        $data['user'] = Auth::user();
        $response = $this->cartService->cart();
        if($response['success']&&$response['data']['quantity']>0){
            return view('user.cart.checkout', $data);
        }else{
            return redirect()->back()->with('error', 'Empty Cart');
        }
    }
}
