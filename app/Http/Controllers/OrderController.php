<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\StorageService;
// use PDF;

class OrderController extends Controller
{
    protected $storageService;

    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function confirm(Request $request)
    {
        $carts = session()->get('cart');
        $customer = auth()->guard('user')->user();

        if (isset($customer)) {
            $customerId = $customer->id;
        } else {
            $customerId = 2;
        }

        if (isset($carts)) {
            // if (isset($customer)) {
            //     $mail = $customer['email'];
            //     $name = $customer['name'];
            // } else {
            //     $mail = $request['email'];
            //     $name = $request['name'];
            // }

            // $order = $request;
            // Mail::send('home.mail.mail-cart', compact('name', 'carts', 'order'), function($email) use($mail, $name){
            //     $email->subject('Techshop - Xác nhận đơn hàng');
            //     $email->to($mail, $name);
            // });

            $subTotal = 0;

            foreach ($carts as $cart) {
                $orderDetail = [
                    'quantity'  => $cart['quantity'],
                    'price'     => $cart['price'],
                    'total'     => $cart['quantity'] * $cart['price'],
                ];
                $total = $orderDetail['total'];
                $subTotal += $total;
            }

            $data = [
                'user_id'   => $customerId,
                'name'      => $request->name,
                'email'     => $request->email,
                'address'   => $request->address,
                'phone'     => $request->phone,
                'note'      => $request->note,
                'subTotal'  => $subTotal,
            ];

            $order = Order::create($data);
        
            foreach ($carts as $cart) {
                $orderDetail = [
                    'order_id'      => $order->id,
                    'product_id'    => $cart['id'],
                    'name'          => $cart['name'],
                    'quantity'      => $cart['quantity'],
                    'price'         => $cart['price'],
                    'total'         => $cart['quantity'] * $cart['price'],
                    'image'         => $cart['image'],
                ];

                $subtract = $this->storageService->subtractOrder($orderDetail['product_id'], $orderDetail['quantity']);
        
                if ($subtract != false) {
                    OrderDetail::create($orderDetail);
                }
        
            }
            session()->forget('cart');
        }

        return view('home.pages.thank-you');
    }

    public function list()
    {
        return view('dashboard.list.order', [
            'orders' => Order::all(),
            'breadcrumb' => 'order'
        ]);
    }

    public function detail($id)
    {
        $order = Order::where('id', $id)->first();

        return view('dashboard.update.order', [
            'order'         => $order,
            'orderDetail'   => $order->orderDetail,
            'breadcrumb'    => 'order'
        ]);
    }

    public function update($id, $type)
    {
        $order = Order::where('id', $id)->first();

        if ($type === 'confirm' &&  $order->status < 1) :
            $check = Order::where('id', $id)->update(['status' => 1]);
        endif;
        if ($type === 'shipping' && $order->status < 2) :
            $check = Order::where('id', $id)->update(['status' => 2]);
        endif;
        if ($type === 'done' && $order->status < 3) :
            $check = Order::where('id', $id)->update(['status' => 3]);
        endif;

        if (null !== $check || isset($check)) :
            return redirect()->route('dashboard.order.list')->with('msg', 'Cập nhật thành công');
        endif;

        return redirect()->back()->with('errMsg', 'Cập nhật thất bại');
    }

    public function history()
    {
        $customer = auth()->guard('user')->user();
dd($customer);
        if (isset($customer)) {
            $orders = Order::where('user_id', $customer->id)->get();

            return view('home.pages.history', [
                'orders' => $orders,
            ]);
        }
            
        return redirect()->route('home');
    }

    public function historyDetail($id)
    {
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        $customer = auth()->guard('user')->user();

        // if (request('pdf', false)) {
        //     $pdf = PDF::loadView('home.pdf.order-detail', compact('orderDetails', 'customer'));

        //     return $pdf->stream();
        // }

        return view('home.pages.history-detail', [
            'orderDetails' => $orderDetails
        ]);
    }
}
