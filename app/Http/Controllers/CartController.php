<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use App\Cart\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $validatedData['product_id'];
        $quantity = $validatedData['quantity'];

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Product::find($productId);
            if ($product) {
                $cart[$productId] = [
                    "image" => $product->imagen,
                    "name" => $product->nombre,
                    "quantity" => $quantity,
                    "price" => $product->precio
                ];
            } else {
                return response()->json(['message' => 'Producto no encontrado'], 404);
            }
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Producto añadido al carrito',
            'cart' => $cart
        ]);
    }

    

    public function updateCart(Request $request, $productId)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($this->service->updateCartItem($productId, $validatedData['quantity'])) {
            return response()->json(['message' => 'Carrito actualizado']);
        }

        return response()->json(['message' => 'Producto no encontrado en el carrito'], 404);
    }

    public function removeFromCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        // Verifica si el producto existe en el carrito
        if (isset($cart[$productId])) {
            // Disminuir la cantidad en 1
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            } else {
                // Si la cantidad es 1, eliminar completamente el producto del carrito
                unset($cart[$productId]);
            }
            
            // Guardar el carrito actualizado en la sesión
            session()->put('cart', $cart);
        }

        return response()->json([
            'message' => 'Producto actualizado/eliminado del carrito',
            'cart' => $cart
        ]);
    }



    public function completePurchase()
    {
        // Obtén los productos del carrito de la sesión
        $cartItems = session('cart', []);

        // Genera un ID único para el carrito
        $cartId = uniqid();

        // Itera sobre los elementos del carrito y guárdalos en la base de datos con el mismo ID de carrito
        foreach ($cartItems as $productId => $details) {
            $cartItem = new Cart([
                'order_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $details['quantity'],
                'price' => $details['price'] * $details['quantity'],
            ]);
            $cartItem->save();
        }

        // Limpia la variable de sesión 'cart'
        session()->forget('cart');

        // Redirecciona a la página de agradecimiento
        return view('thank-you');
    }




}

