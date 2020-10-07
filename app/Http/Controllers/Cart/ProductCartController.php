<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductCartController extends Controller
{
    public $cartService;

    /**
     * Undocumented function
     *
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Product $product
     */
    public function store(Request $request, Product $product)
    {
        $cart = $this->cartService->getFromCookieOrCreate();

        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1]

        ]);

        $cookie = $this->cartService->makeCookie($cart);

        return redirect()->back()->cookie($cookie);
    }


    /**
     * Undocumented function
     *
     * @param Product $product
     * @param Cart $cart
     * @return void
     */
    public function destroy(Product $product, Cart $cart)
    {

        $cart->products()->detach($product->id);

        $cookie = $this->cartService->makeCookie($cart);

        return redirect()->back()->cookie($cookie);
    }
}
