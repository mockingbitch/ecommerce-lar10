<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Repositories\Contracts\Interface\StorageRepositoryInterface;
use App\Constants\StorageConstant;
use App\Constants\Constant;
use App\Constants\RouteConstant;
class CartController extends Controller
{
    protected $storageRepository;

    public function __construct(StorageRepositoryInterface $storageRepository)
    {
        $this->storageRepository = $storageRepository;
    }

    public function listCart()
    {
        $carts = \session()->get('cart');

        return view('home.pages.view_cart', [
            'carts' => $carts
        ]);
    }

    public function create(Request $request)
    {
        try {
            $product = $this->storageRepository->find($request->id);
        
            if (! isset($product) || null == $product || $product->quantity < (int) $request->quantity) :
                return [
                    'type' => 'warning'
                ];
            endif;

            $id     = $product->id;
            $cart   = session()->get('cart');
    
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
            } else {
                $cart[$id]=[
                    'id'        => $product->id,
                    'name'      => $product->product_model->name,
                    'price'     => $product->price,
                    'quantity'  => (int) $request->quantity,
                    'color'     => $product->color,
                    'image'     => $product->image
                ];
            }
    
            session()->put('cart', $cart);

            return [
                'type' => 'success',
                'cart' => session()->get('cart')
            ];
        } catch (\Throwable $th) {
            return ['type' => 'error'];
        }
    }

    public function update(Request $request)
    {
        try {
            if ($request->id && $request->quantity) {
                $cart = session()->get('cart');
                if (isset($cart[$request->id])) :
                    $cart[$request->id]['quantity'] = (int) $request->quantity;
                endif;
            }
    
            session()->put('cart', $cart);

            return ['type' => 'success'];
        } catch (\Throwable $th) {
            return ['type' => 'error'];
        }
    }

    public function remove(Request $request)
    {
        try {
            if ($request->id) {
                $cart = session()->get('cart');
                unset($cart[$request->id]);
    
                session()->put('cart', $cart);
            }
    
            return ['type' => 'success'];
        } catch (\Throwable $th) {
            return ['type' => 'error'];
        }
    }

    public function checkout()
    {
        return view('home.pages.checkout', [
            'carts' => session()->get('cart')
        ]);
    }
}