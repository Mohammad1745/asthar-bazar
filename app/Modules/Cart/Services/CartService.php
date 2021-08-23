<?php


namespace App\Modules\Cart\Services;


use App\Modules\Cart\Repositories\CartDetailsRepository;
use App\Modules\Cart\Repositories\CartRepository;
use App\Modules\Cart\Repositories\ProductRepository;
use App\Modules\Cart\Repositories\ProductVariationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService
{
    private $errorMessage;
    private $errorResponse;
    private $cartRepository;
    private $cartDetailsRepository;
    private $productRepository;
    private $productVariationRepository;

    /**
     * CartService constructor.
     * @param CartRepository $cartRepository
     * @param CartDetailsRepository $cartDetailsRepository
     * @param ProductRepository $productRepository
     * @param ProductVariationRepository $productVariationRepository
     */
    public function __construct(CartRepository $cartRepository, CartDetailsRepository $cartDetailsRepository, ProductRepository $productRepository, ProductVariationRepository $productVariationRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartDetailsRepository = $cartDetailsRepository;
        $this->productRepository = $productRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->errorMessage = __('Something went wrong');
        $this->errorResponse = [
            'success' => false,
            'message' => $this->errorMessage,
            'data' => [],
            'webResponse' => [
                'dismiss' => $this->errorMessage,
            ],
        ];
    }

    /**
     * @return array
     */
    public function cart()
    {
        try{
            $user = Auth::user();
            $where = ['user_id' => $user->id];
            $cart = $this->cartRepository->whereLast($where);
            if(empty($cart)){
                $cartData = [
                    'user_id' => $user->id,
                    'quantity' => 0,
                    'price' => 0,
                ];
                $cart = $this->cartRepository->create($cartData);
            }
            return [
                'success' => true,
                'message' => 'Cart Found.',
                'data' => $cart,
                'webResponse' => [
                    'success' => 'Cart Found.',
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorResponse;
        }
    }

    /**
     * @param $cart
     * @return mixed
     */
    public function cartDetails($cart)
    {
        $where = ['carts.id' => $cart->id];

        return $this->cartDetailsRepository->details($where);
    }

    /**
     * @return mixed
     */
    public function clearCart()
    {
        try{
            DB::beginTransaction();
            $where = ['user_id' => Auth::user()->id];
            $cart = $this->cartRepository->whereLast($where);
            $cartData = [
                'quantity' => 0,
                'price' => 0,
            ];
            $this->cartRepository->update($where, $cartData);
            $where = ['cart_id' => $cart->id];
            $cartDetails = $this->cartDetailsRepository->getWhere($where);
            foreach ($cartDetails as $cartDetail){
                $where = ['id' => $cartDetail->id];
                $this->cartDetailsRepository->deleteWhere($where);
            }
            DB::commit();

            return [
                'success' => true,
                'message' => 'Cart Cleared.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Cart Cleared.',
                ],
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $encryptedProductVariationId
     * @return mixed
     */
    public function addProductVariation($encryptedProductVariationId)
    {
        try{
            DB::beginTransaction();
            $where = ['user_id' => Auth::user()->id];
            $cart = $this->cartRepository->whereLast($where);
            $where = ['id' => decrypt($encryptedProductVariationId)];
            $productVariation = $this->productVariationRepository->whereLast($where);
            $where = [
                'product_variation_id' => $productVariation['id'],
                'cart_id' => $cart->id,
            ];
            $cartDetail = $this->cartDetailsRepository->whereLast($where);
            if(empty($cartDetail)){
                $cartDetailData = [
                    'cart_id' => $cart->id,
                    'product_id' => $productVariation['product_id'],
                    'product_variation_id' => $productVariation['id'],
                    'quantity' => 1,
                    'price' => $productVariation['unit_price']
                ];
                $cartDetail = $this->cartDetailsRepository->create($cartDetailData);
            }else{
                $quantity = $cartDetail['quantity'] + 1;
                $cartDetailData = [
                    'quantity' => $quantity,
                    'price' => $quantity * $productVariation['unit_price'],
                ];
                $this->cartDetailsRepository->update($where, $cartDetailData);
            }
            $where = ['id' => $cart->id];
            $cartData = [
                'quantity' => $cart->quantity + 1,
                'price' => $cart->price + $productVariation['unit_price'],
            ];
            $this->cartRepository->update($where, $cartData);
            DB::commit();

            return [
                'success' => true,
                'message' => 'Product Added to Cart.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Product Added to Cart.',
                ],
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function updateCart($request)
    {
        try{
            DB::beginTransaction();
            $where = ['user_id' => Auth::user()->id];
            $cart = $this->cartRepository->whereLast($where);
            $totalQuantity = 0;
            $totalPrice = 0;
            for ($key=0; $key<sizeof($request->id); $key++){
                $where = ['id' => $request->product_variation_id[$key]];
                $productVariation = $this->productVariationRepository->whereLast($where);
                $where = [
                    'product_variation_id' => $productVariation['id'],
                    'cart_id' => $cart->id,
                ];
                $cartDetail = $this->cartDetailsRepository->whereLast($where);
                $where = ['id' => $cartDetail->id];
                $quantity = $request->quantity[$key];
                $price = $quantity * $productVariation['unit_price'];
                if($quantity<=0){
                    $this->cartDetailsRepository->deleteWhere($where);
                }else{
                    $cartDetailData = [
                        'quantity' => $quantity,
                        'price' => $price,
                    ];
                    $this->cartDetailsRepository->update($where, $cartDetailData);
                    $totalQuantity += $quantity;
                    $totalPrice += $price;
                }
            }
            $where = ['id' => $cart->id];
            $cartData = [
                'quantity' => $totalQuantity,
                'price' => $totalPrice,
            ];
            $this->cartRepository->update($where, $cartData);
            DB::commit();

            return [
                'success' => true,
                'message' => 'Cart has been updated.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Cart has been updated.',
                ],
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }
}
