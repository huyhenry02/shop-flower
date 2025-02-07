<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $orders = Order::all();
        return view('admin.page.order.index',
            [
                'orders' => $orders
            ]);
    }

    public function showCreate(): View|Factory|Application
    {
        $products = Product::all();
        return view('admin.page.order.create',
            [
                'products' => $products
            ]);
    }

    public function showUpdate($id): View|Factory|Application
    {
        // $order = Order::where('id', $id)->first();
        // $order_detail = OrderDetail::where('id', $id)->first();
        $orders_orderDetails_prods = DB::table('order_details')
                                ->join('products', 'products.id', 'order_details.product_id')
                                ->join('orders', 'orders.id', 'order_details.order_id')
                                ->where('orders.id', $id)
                                ->select(
                                    'orders.id as id_order',
                                    'orders.shipping_name as name_cus',
                                    'orders.shipping_phone as phone_cus',
                                    'orders.shipping_address as addr_cus',
                                    'orders.shipping_email as email_cus',
                                    'orders.note as note_cus',
                                    'products.id as id_prod',
                                    'products.name as name_prod',
                                    'order_details.quantity'
                                    // 'products.name as price_prod'
                                )
                                ->first();
                                // dd($orders_orderDetails_prods);
        $products = Product::all();
        // $product = Product::all();
        return view('admin.page.order.update',
            [
                'products' => $products,
                // 'order' => $order,
                // 'order_detail' => $order_detail,
                'orders_orderDetails_prods' => $orders_orderDetails_prods
            ]
        );
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['status'] = Order::STATUS_PENDING;
            $input['user_id'] = auth()->id();
            $input['order_date'] = date('Y-m-d');
            $input['code'] = 'OD' . date('Ymd') . '-' . $input['user_id'] . '/' . random_int(1, 100);
            $inputOrderDetails = $input['products'];
            $totalAmount = 0;
            foreach ($inputOrderDetails as $product) {
                $product['sub_total'] = (int)str_replace('.', '', $product['sub_total']);
                $totalAmount += $product['sub_total'];
            }
            $input['total'] = $totalAmount;
            $order = new Order();
            $order->fill($input);
            $order->save();
            dd($order);

            foreach ($inputOrderDetails as $inputOrderDetail) {
                $orderDetail = new OrderDetail();
                $inputOrderDetail['sub_total'] = (int)str_replace('.', '', $inputOrderDetail['sub_total']);
                $orderDetail->fill($inputOrderDetail);
                $orderDetail->order_id = $order->id;
                $orderDetail->save();
            }

            DB::commit();
            return redirect()->route('admin.order.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function postUpdate(Request $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['status'] = Order::STATUS_PENDING;
            $input['user_id'] = auth()->id();
            $input['order_date'] = date('Y-m-d');
            $input['code'] = 'OD' . date('Ymd') . '-' . $input['user_id'] . '/' . random_int(1, 100);
            $inputOrderDetails = $input['products'];
            $totalAmount = 0;
            foreach ($inputOrderDetails as $product) {
                $product['sub_total'] = (int)str_replace('.', '', $product['sub_total']);
                $totalAmount += $product['sub_total'];
            }
            $input['total'] = $totalAmount;
            $order = Order::where('id', $id)->first();
            $order->fill($input);
            dd($order->getDirty());

            $order->save() ; // vđ
            
            

            foreach ($inputOrderDetails as $inputOrderDetail) {
                $orderDetail = new OrderDetail();
                $inputOrderDetail['sub_total'] = (int)str_replace('.', '', $inputOrderDetail['sub_total']);
                $orderDetail->fill($inputOrderDetail);
                $orderDetail->order_id = $order->id;
                $orderDetail->save();
            }

            DB::commit();
            return redirect()->route('admin.order.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
    
}
