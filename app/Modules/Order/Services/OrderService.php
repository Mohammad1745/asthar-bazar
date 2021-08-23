<?php


namespace App\Modules\Order\Services;


use App\Modules\Order\Repositories\CartDetailsRepository;
use App\Modules\Order\Repositories\CartRepository;
use App\Modules\Order\Repositories\DepartmentRepository;
use App\Modules\Order\Repositories\DepartmentTransactionRepository;
use App\Modules\Order\Repositories\OrderChargeRepository;
use App\Modules\Order\Repositories\OrderDetailsRepository;
use App\Modules\Order\Repositories\OrderPaymentRepository;
use App\Modules\Order\Repositories\OrderRepository;
use App\Modules\Order\Repositories\ProductRepository;
use App\Modules\Order\Repositories\ProductVariationRepository;
use App\Modules\Order\Repositories\ReferralUserRepository;
use App\Modules\Order\Repositories\SaleRecordRepository;
use App\Modules\Order\Repositories\TypeRepository;
use App\Modules\Order\Repositories\UserWalletRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class OrderService
{
    private $errorMessage;
    private $errorResponse;
    private $orderRepository;
    private $userWalletRepository;
    private $referralUserRepository;
    private $orderDetailsRepository;
    private $orderPaymentRepository;
    private $orderChargeRepository;
    private $cartRepository;
    private $cartDetailsRepository;
    private $productRepository;
    private $productVariationRepository;
    private $typeRepository;
    private $departmentRepository;
    private $departmentTransactionRepository;
    private $saleRecordRepository;

    /**
     * OrderService constructor.
     * @param UserWalletRepository $userWalletRepository
     * @param ReferralUserRepository $referralUserRepository
     * @param OrderRepository $orderRepository
     * @param OrderDetailsRepository $orderDetailsRepository
     * @param OrderPaymentRepository $orderPaymentRepository
     * @param OrderChargeRepository $orderChargeRepository
     * @param CartRepository $cartRepository
     * @param CartDetailsRepository $cartDetailsRepository
     * @param ProductRepository $productRepository
     * @param ProductVariationRepository $productVariationRepository
     * @param TypeRepository $typeRepository
     * @param DepartmentRepository $departmentRepository
     * @param DepartmentTransactionRepository $departmentTransactionRepository
     * @param SaleRecordRepository $saleRecordRepository
     */
    public function __construct(
        UserWalletRepository $userWalletRepository,
        ReferralUserRepository $referralUserRepository,
        OrderRepository $orderRepository,
        OrderDetailsRepository $orderDetailsRepository,
        OrderPaymentRepository $orderPaymentRepository,
        OrderChargeRepository $orderChargeRepository,
        CartRepository $cartRepository,
        CartDetailsRepository $cartDetailsRepository,
        ProductRepository $productRepository,
        ProductVariationRepository $productVariationRepository,
        TypeRepository $typeRepository,
        DepartmentRepository $departmentRepository,
        DepartmentTransactionRepository $departmentTransactionRepository,
        SaleRecordRepository $saleRecordRepository
    )
    {
        $this->userWalletRepository = $userWalletRepository;
        $this->referralUserRepository = $referralUserRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailsRepository = $orderDetailsRepository;
        $this->orderPaymentRepository = $orderPaymentRepository;
        $this->orderChargeRepository = $orderChargeRepository;
        $this->cartRepository = $cartRepository;
        $this->cartDetailsRepository = $cartDetailsRepository;
        $this->productRepository = $productRepository;
        $this->productVariationRepository = $productVariationRepository;
        $this->typeRepository = $typeRepository;
        $this->departmentRepository = $departmentRepository;
        $this->departmentTransactionRepository = $departmentTransactionRepository;
        $this->saleRecordRepository = $saleRecordRepository;
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
    public function orders()
    {
        $user = Auth::user();
        $where = ['user_id' => $user->id];
        return $this->orderRepository->getWhere($where);
    }

    /**
     * @param $encryptedOrderId
     * @return mixed
     */
    public function order($encryptedOrderId)
    {
        $where = ['id' => decrypt($encryptedOrderId)];

        return $this->orderRepository->whereLast($where);
    }


    /**
     * @param $encryptedOrderId
     * @return mixed
     */
    public function orderDetails($encryptedOrderId)
    {
        $where = ['order_id' => decrypt($encryptedOrderId)];

        return $this->orderDetailsRepository->getWhere($where);
    }


    /**
     * @param $encryptedOrderId
     * @return mixed
     */
    public function orderPayments($encryptedOrderId)
    {
        $where = ['order_id' => decrypt($encryptedOrderId)];

        return $this->orderPaymentRepository->getWhere($where);
    }


    /**
     * @param $encryptedOrderId
     * @return mixed
     */
    public function orderCharges($encryptedOrderId)
    {
        $where = ['order_id' => decrypt($encryptedOrderId)];

        return $this->orderChargeRepository->getWhere($where);
    }


    /**
     * @param $request
     * @return mixed
     */
    public function storeCharge($request)
    {
        try {
            DB::beginTransaction();
            $chargeData = $this->prepareChargesData($request);
            $charges = 0;
            foreach ($chargeData as $charge){
                $this->orderChargeRepository->create($charge);
                $charges += $charge['amount'];
            }
            $where = ['id' => $request->order_id];
            $order = $this->orderRepository->whereLast($where);
            $orderData = [
                'charges' => $charges,
                'total_price' => $charges + $order->total_price
            ];
            $this->orderRepository->update($where, $orderData);
            DB::commit();

            return [
                'success' => true,
                'message' => 'Order Charges Added.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Order Charges Added.',
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
    private function prepareChargesData($request)
    {
        $preparedData = [];
        foreach ($request->title as $key => $title){
            $data = [
                'order_id' => $request->order_id,
                'title' => $title,
                'option' => $title,
                'amount' => $request->amount[$key]
            ];
            array_push($preparedData, $data);
        }

        return $preparedData;
    }

    /**
     * @param $encryptedOrderId
     * @return array
     */
    public function makePaymentDone($encryptedOrderId)
    {
        try {
            DB::beginTransaction();
            $where = ['id' => decrypt($encryptedOrderId)];
            $order = $this->orderRepository->whereLast($where);
            $orderPaymentData = [
                'order_id' => $order->id,
                'title' => $order->payment_method,
                'option' => $order->payment_method,
                'amount' => $order->total_price-$order->paid,
            ];
            $this->orderPaymentRepository->create($orderPaymentData);
            $orderData = [
                'paid' => $order->total_price,
                'payment_status' => PAYMENT_DONE_STATUS,
                'shipping_status' => DELIVERY_PROCESSING_STATUS
            ];
            $this->orderRepository->update($where, $orderData);
            DB::commit();

            return [
                'success' => true,
                'message' => 'Payment Status Done.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Payment Status Done.',
                ],
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $encryptedOrderId
     * @return array
     */
    public function makeOrderComplete($encryptedOrderId)
    {
        try {
            DB::beginTransaction();
            $where = ['id' => decrypt($encryptedOrderId)];
            $order = $this->orderRepository->whereLast($where);
            if($order->total_price==$order->paid&&$order->payment_status==PAYMENT_DONE_STATUS){
                $orderData = ['shipping_status' => DELIVERY_COMPLETED_STATUS];
                $this->orderRepository->update($where, $orderData);
                $departmentTransactionData = $this->prepareDepartmentTransactionData($order);
                foreach ($departmentTransactionData as $transactionDatum) {
                    $this->departmentTransactionRepository->create($transactionDatum);
                }
                $this->storeSaleRecord($order);
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Order Completed.',
                    'data' => [],
                    'webResponse' => [
                        'success' => 'Order Completed.',
                    ],
                ];
            }else{
                return $this->errorResponse;
            }
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $order
     * @return mixed
     */
    private function prepareDepartmentTransactionData($order)
    {
        $preparedData = [];
        $where = ['title' => 'wallet'];
        $walletPayment = $this->orderPaymentRepository->whereLast($where);
        $revenueFromWallet = 0;
        if(!empty($walletPayment)){
            $revenueFromWallet = $walletPayment->amount;
        }
        $where = ['order_id' => $order->id];
        $orderDetails = $this->orderDetailsRepository->groupByWhere($where, 'department_title');
        foreach($orderDetails as $key => $items){
            $where = ['title' => $key];
            $department = $this->departmentRepository->whereLast($where);
            $revenue = 0;
            $manufacturingCost = 0;
            foreach ($items as $item){
                $where=['id' =>$item->product_variation_id];
                $productVariation = $this->productVariationRepository->whereLast($where);
                $revenue += $item->price;
                $manufacturingCost += $item->quantity*$productVariation->manufacturing_cost;
            }
            $profit = $revenue-$manufacturingCost;
            $customerReward = $this->distributeCustomerReward($order, $profit);
            $addedRevenueFromWallet = $revenue<$revenueFromWallet ? $revenue : $revenueFromWallet;
            $transactionData = [
                'department_id' => $department->id,
                'revenue' => $revenue,
                'revenue_from_wallet' => $addedRevenueFromWallet,
                'manufacturing_cost' => $manufacturingCost,
                'profit' => $profit,
                'customer_reward' => $customerReward,
                'net_profit' => $profit-$customerReward,
                'status' => true
            ];
            $revenueFromWallet -= $addedRevenueFromWallet;
            array_push($preparedData, $transactionData);
        }

        return $preparedData;
    }

    /**
     * @param $order
     * @param $profit
     * @return int
     */
    public function distributeCustomerReward($order, $profit)
    {
        $reward = 0;
        $customerId = $order->user_id;
        $where = ['child_id' => $customerId];
        $referralUser = $this->referralUserRepository->whereLast($where);
        if(!empty($referralUser)){
            $where = ['user_id' => $referralUser->parent_id];
            $userWallet = $this->userWalletRepository->whereLast($where);
            $walletData = ['amount' => ($userWallet->amount + $profit*0.01 > $userWallet->capacity) ? $userWallet->capacity : $userWallet->amount + $profit*0.01];
            $this->userWalletRepository->update($where, $walletData);
            $reward += $profit*0.01;
        }
        $where = ['user_id' => $customerId];
        $userWallet = $this->userWalletRepository->whereLast($where);
        $walletData = ['amount' => ($userWallet->amount + $profit*0.01 > $userWallet->capacity) ? $userWallet->capacity : $userWallet->amount + $profit*0.01];
        $this->userWalletRepository->update($where, $walletData);
        $reward += $profit*0.01;

        return $reward;
    }

    /**
     * @param $order
     */
    private function storeSaleRecord($order)
    {
        $where = ['order_id' => $order->id];
        $orderDetails = $this->orderDetailsRepository->groupByWhere($where, 'department_title');
        foreach($orderDetails as $key => $items){
            $where = ['title' => $key];
            $department = $this->departmentRepository->whereLast($where);
            foreach ($items as $item){
                $where = [
                    'department_id' => $department->id,
                    'product_variation_id' => $item->product_variation_id,
                    'product_variation_title' => $item->product_variation_title,
                    'product_title' => $item->product_title,
                    'type_title' => $item->type_title,
                ];
                $saleRecord = $this->saleRecordRepository->whereLast($where);
                if(empty($saleRecord)){
                    $where['quantity'] = $item->quantity;
                    $where['unit_of_quantity'] = $item->unit_of_quantity;
                    $this->saleRecordRepository->create($where);
                }else{
                    $saleRecordData = ['quantity' => $saleRecord->quantity+$item->quantity];
                    $this->saleRecordRepository->update($where, $saleRecordData);
                }
            }
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function placeOrder($request)
    {
        try{
            DB::beginTransaction();
            $where = ['user_id' => Auth::user()->id];
            $cart = $this->cartRepository->whereLast($where);
            $where = ['cart_id' => $cart->id];
            $cartDetails = $this->cartDetailsRepository->getWhere($where);
            $orderData = $this->prepareOrderData($request, $cart);
            $order = $this->orderRepository->create($orderData);
            $totalWeight = 0;
            foreach ($cartDetails as $cartDetail){
                $orderDetailData = $this->prepareOrderDetailData($order->id, $cartDetail);
                if(isset($orderDetailData['success'])&&!$orderDetailData['success']){
                    DB::rollBack();

                    return $orderDetailData;
                }
                $orderDetail = $this->orderDetailsRepository->create($orderDetailData);
                $totalWeight += $orderDetail->weight;
                $where = ['id' => $cartDetail->id];
                $this->cartDetailsRepository->deleteWhere($where);
            }
            $where = ['id' => $order->id];
            $updatedData = $this->prepareUpdatedOrderData($order, $cart, $request, $totalWeight);
            $this->orderRepository->update($where, $updatedData);
            $where = ['id' => $cart->id];
            $this->cartRepository->deleteWhere($where);
            DB::commit();

            return [
                'success' => true,
                'message' => 'Order Placed.',
                'data' => [],
                'webResponse' => [
                    'success' => 'Order Placed.',
                ],
            ];
        }catch (\Exception $exception){
            DB::rollBack();

            return $this->errorResponse;
        }
    }

    /**
     * @param $request
     * @param $cart
     * @return array
     */
    private function prepareOrderData($request, $cart)
    {
        return [
            'user_id' => Auth::user()->id,
            'order_code' => 111111,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_code' => $request->phone_code,
            'phone' => $request->phone,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'country' => $request->country,
            'quantity' => $cart->quantity,
            'subtotal' => $cart->price,
            'total_weight' => 0,
            'charges' => 0,
            'total_price' => $cart->price,
            'paid' => 0,//$request->coupon,
            'payment_method' => 'bKash',
            'shipping_method' => 'SA Paribahan',
            'payment_status' => PAYMENT_PENDING_STATUS,
            'shipping_status' => DELIVERY_PENDING_STATUS,
        ];
    }

    /**
     * @param $order
     * @param $cart
     * @param $request
     * @param $totalWeight
     * @return array
     */
    private function prepareUpdatedOrderData($order, $cart, $request, $totalWeight)
    {
        $preparedData = [
            'order_code' => $order->order_code + $order->id,
            'total_weight' => $totalWeight
        ];
        $wallet = wallet();
        if(isset($request->wallet_payment_checkbox)){
            $fromWallet = $wallet->amount>=$cart->price ? $cart->price : $wallet->amount;
            $preparedData['paid'] = $fromWallet;
            $where = ['id' => $wallet->id];
            $walletData = ['amount' => $wallet->amount - $fromWallet];
            $this->userWalletRepository->update($where, $walletData);
            $orderPaymentData = [
                'order_id' => $order->id,
                'title' => 'wallet',
                'option' => 'wallet',
                'amount' => $fromWallet
            ];
            $this->orderPaymentRepository->create($orderPaymentData);
        }

        return $preparedData;
    }

    /**
     * @param $orderId
     * @param $cartDetail
     * @return array
     */
    private function prepareOrderDetailData($orderId, $cartDetail)
    {
        $where = ['id' => $cartDetail->product_variation_id];
        $productVariation = $this->productVariationRepository->whereLast($where);
        $where = ['id' => $productVariation->product_id];
        $product = $this->productRepository->whereLast($where);
        $where = ['id' => $productVariation->type_id];
        $type = $this->typeRepository->whereLast($where);
        $where = ['id' => $type->department_id];
        $department = $this->departmentRepository->whereLast($where);

        $preparedData = [
            'order_id' => $orderId,
            'product_title' => $product->title,
            'product_variation_id' => $productVariation->id,
            'product_variation_title' => $productVariation->title,
            'type_title' => $type->title,
            'department_title' => $department->title,
            'description' => $productVariation->description,
            'unit_price' => $productVariation->unit_price,
            'weight_per_unit' => $productVariation->weight_per_unit,
            'unit_of_quantity' => $productVariation->unit_of_quantity,
            'quantity' => $cartDetail->quantity,
            'price' => $cartDetail->price,
            'weight' => $cartDetail->quantity * $productVariation->weight_per_unit,
        ];
        if($productVariation->quantity<$preparedData['quantity']){
            $this->errorResponse['webResponse']['dismiss'] = $productVariation->title.' doesn\'t have enough quantity.';

            return $this->errorResponse;
        }
        $variationData = ['quantity' => $productVariation->quantity-$preparedData['quantity']];
        $where = ['id' => $productVariation->id];
        $this->productVariationRepository->update($where, $variationData);

        return $preparedData;
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function allOrderListQuery() {
        $order = $this->orderRepository->getAllQuery();
        try {
            return datatables($order)
                ->editColumn('order_code', function ($item) {
                    return '#'.$item->order_code;
                })
                ->editColumn('created_at', function ($item) {
                    $date = new Carbon($item->created_at);
                    return date_format($date, 'Y-m-d');
                })
                ->addColumn('total_weight', function ($item) {
                    return $item->total_weight.'kg';
                })
                ->editColumn('total_price', function ($item) {
                    return '৳'.$item->total_price;
                })
                ->editColumn('payment_status', function ($item) {
                    return paymentStatus($item->payment_status);
                })
                ->editColumn('shipping_status', function ($item) {
                    return deliveryStatus($item->shipping_status);
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('admin.order.details', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return array|JsonResponse|mixed
     */
    public function orderListQuery() {
        $where = ['user_id' => Auth::user()->id];
        $order = $this->orderRepository->getWhereQuery($where);
        try {
            return datatables($order)
                ->editColumn('order_code', function ($item) {
                    return '#'.$item->order_code;
                })
                ->editColumn('created_at', function ($item) {
                    $date = new Carbon($item->created_at);
                    return date_format($date, 'Y-m-d');
                })
                ->addColumn('total_weight', function ($item) {
                    return $item->total_weight.'kg';
                })
                ->editColumn('total_price', function ($item) {
                    return '৳'.$item->total_price;
                })
                ->editColumn('payment_status', function ($item) {
                    return paymentStatus($item->payment_status);
                })
                ->editColumn('shipping_status', function ($item) {
                    return deliveryStatus($item->shipping_status);
                })
                ->addColumn('actions', function ($item) {
                    $generatedData = '<ul class="d-flex justify-content-center activity-menus mb-0">';

                    $generatedData .= '<a class="text-primary" href="';
                    $generatedData .= route('order.details', encrypt($item->id));
                    $generatedData .= '" data-toggle="tooltip" title="Edit">';
                    $generatedData .= '<i class="fa fa-eye"></i>';
                    $generatedData .= '</a>';
                    $generatedData .= '</ul>';

                    return $generatedData;
                })
                ->rawColumns(['actions'])
                ->make(true);
        } catch (\Exception $e) {
            return [];
        }
    }
}
