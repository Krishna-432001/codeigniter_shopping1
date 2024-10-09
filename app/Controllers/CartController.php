<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Cart;

class CartController extends BaseController
{
    protected $cart;
    protected $product;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->product = new Product();
    }

    // Display the cart
    public function index()
    {
        $userId = session()->get('user_id'); // Assuming you are using session for user authentication
        $data['carts'] = $this->cart->where('user_id', $userId)->findAll();

        return view('frontend/cart/cart', $data); // Update with your view path
    }

    // Add product to cart
    public function add($productId)
    {
        $userId = session()->get('user_id');

        // Check if the product exists
        $product = $this->product->find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Check if the product is already in the cart
        $cartItem = $this->cart->where(['user_id' => $userId, 'product_id' => $productId])->first();

        if ($cartItem) {
            // Update quantity if it already exists
            $this->cart->update($cartItem['id'], [
                'quantity' => $cartItem['quantity'] + 1,
            ]);
        } else {
            // Add new item to cart
            $this->cart->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return redirect()->to('/cart')->with('success', 'Product added to cart');
    }

    // Update cart item quantity
    public function update($cartId)
    {
        $quantity = $this->request->getPost('quantity');

        if ($quantity < 1) {
            return redirect()->to('/cart')->with('error', 'Quantity must be greater than zero');
        }

        $cartItem = $this->cart->find($cartId);
        if (!$cartItem) {
            return redirect()->to('/cart')->with('error', 'Cart item not found');
        }

        $this->cart->update($cartId, [
            'quantity' => $quantity,
        ]);

        return redirect()->to('/cart')->with('success', 'Cart updated successfully');
    }

    // Remove product from cart
    public function remove($cartId)
    {
        $cartItem = $this->cart->find($cartId);
        if (!$cartItem) {
            return redirect()->to('/cart')->with('error', 'Cart item not found');
        }

        $this->cart->delete($cartId);
        return redirect()->to('/cart')->with('success', 'Product removed from cart');
    }

    // Clear the cart
    public function clear()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/cart')->with('error', 'User not authenticated');
        }

        $this->cart->where('user_id', $userId)->delete();
        return redirect()->to('/cart')->with('success', 'Cart cleared successfully');
    }
}
