<?php
namespace App\TheApp\Repository\Api\Orders;

use App\TheApp\Repository\Api\Transaction\TransactionRepository;
use App\Http\Resources\Orders\OrderResource;
use App\TheApp\Libraries\ImgRepository;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;
use ProductsQty;
use Auth;
use DB;

class OrderRepository
{
    protected $model;

    function __construct(Order $order , OrderDetail $details,TransactionRepository $transaction)
    {
        $this->transaction  = $transaction;
        $this->model        = $order;
        $this->modelDetails = $details;
    }  

    public function myOrders($request)
    {
        $orders = $this->model->where('user_id',$request['user_id'])->get();

        return $orders;
    }


    public function orderById($id)
    {
        $order = $this->model->find($id);

        return $order;
    }

    public function addNewOrder($request)
    {
        $order  = $this->calculateTotal($request);

        return $order;
    }

    public function calculateTotal($request)
    {
        $subtotal = 0;

        foreach ($request['product_ids'] as $product) {
            $item_ = Product::find($product['product_id']);
            $subtotal += $item_['price'] * $product['qty'];
        }

        $order = $this->createOrder($request,$subtotal);

        if ($order) {
            return $order;
        }

    }

    public function createOrder($request,$subtotal)
    {            
        DB::beginTransaction();

        try {
            
            $order = $this->model->create([
                'subtotal'          => $subtotal,
                'shipping'          => $request['shipping'],
                'total'             => $subtotal + $request['shipping'],
                'method'            => 'KNET',
                'address_id'        => $request['address_id'],
                'user_id'           => $request['user_id'],
                'note'              => $request['note'],
                'time'              => $request['time'],
                'order_status_id'   => 5,
            ]);


            if ($order)
                $orderDetails = $this->createOrderDetails($order['id'],$request);
            

            DB::commit();
            return $order;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }

    public function createOrderDetails($orderId,$request)
    {
        DB::beginTransaction();

        try {

            foreach ($request['product_ids'] as $product) {
                $this->modelDetails->create([
                'product_id' => $product['product_id'],
                'product_id' => $product['product_id'],
                'qty'        => $product['qty'],
                'order_id'   => $orderId,
                'price'     => Product::find($product['product_id'])->price,
                'total'  => Product::find($product['product_id'])->price * $product['qty'],
                ]);
            }

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }


    public function finalStep($data)
    {
        $transaction = $this->transaction->addNew($data);
        
        $order = $this->orderById($data['udf1']);
        
        DB::beginTransaction();

        try {
            
            $order = $order->update([
                'order_status_id'   => 1,
            ]);
            

            DB::commit();
            
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }
}