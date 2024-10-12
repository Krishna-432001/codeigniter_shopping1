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
        // Get the user ID from the session
        $userId = session()->get('user')['id'];
    
        // Create a new Cart instance
        $cart = new Cart();
    
        // Fetch cart items for the user
        $data['carts'] = $cart->where('user_id', $userId)->findAll();
    
        // Fetch cart items with product details
        $data['cartItems'] = $cart->getCartWithProductDetails($userId); // Ensure this method fetches based on userId if needed
    
        // Return the view with the cart data
        return view('frontend/cart/cart_screen', $data); // Pass $data array directly
    }
    


    public function add($product_id = null) 
{
    // Assume the user is logged in and you can get user ID from the session
    $user_id = session()->get('user')['id'];
    // $user_id = 1;

    // Retrieve quantity from the URL query parameter
    $quantity = $this->request->getGet('quantity') ? (int)$this->request->getGet('quantity') : 1; // Default to 1 if not provided

    // Validate the product ID
    if (empty($product_id)) {
        return redirect()->back()->with('error', 'Product ID is required.');
    }

    // Load the Product and Cart models
    $product = new Product();
    $cart = new Cart();

    // Retrieve the product
    $product = $product->find($product_id);

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    // Check if the item is already in the cart
    $existingCartItem = $cart->where('product_id', $product_id)
        ->where('user_id', $user_id)
        ->first();

    if ($existingCartItem) {
        // Ensure the qty key exists and update quantity
        $currentQty = isset($existingCartItem['quantity']) ? $existingCartItem['quantity'] : 0;
        $newQty = $currentQty + $quantity;

        // Debugging output
        if ($newQty > 0) {
            $cart->update($existingCartItem['id'], [
                'quantity' => $newQty,
            ]);
            return redirect()->back()->with('success', $product['name'] . " quantity updated in your cart.");
        } else {
            return redirect()->back()->with('error', 'Quantity must be greater than zero.');
        }
    } else {
        // If the item is not in the cart, create a new cart entry
        $cart->insert([
            'product_id' => $product_id,
            'user_id' => $user_id,
            'quantity' => $quantity, // Make sure 'qty' is included
        ]);

        return redirect()->back()->with('success', $product['name'] . " added to your cart.");
    }

    if ($existingCartItem) {
        // Log for debugging
        log_message('debug', 'Existing cart item: ' . print_r($existingCartItem, true));
    }

    if (!$cart->update($existingCartItem['id'], ['quantity' => $newQty])) {
        return redirect()->back()->with('error', 'Failed to update the cart item.');
    }
    
    
}


    // public function add()
    // {
    //     // Assume the user is logged in and you can get user ID from the session
    //     $user_id = session()->get('user_id'); // Adjust this based on how you're managing user sessions
    
    //     // Retrieve product ID and quantity from the request
    //     $product_id = $this->request->getPost('product_id');
    //     $qty = $this->request->getPost('qty') ? (int)$this->request->getPost('qty') : 1; // Default quantity to 1 if not provided
    
    //     // Validate the product ID
    //     if (empty($product_id)) {
    //         return redirect()->back()->with('error', 'Product ID is required.');
    //     }
    
    //     // Load the Product and Cart models
    //     $product = new Product();
    //     $cart = new Cart();
    
    //     // Retrieve the product
    //     $product = $product->find($product_id);
    
    //     if (!$product) {
    //         return redirect()->back()->with('error', 'Product not found.');
    //     }
    
    //     // Check if the item is already in the cart
    //     $existingCartItem = $cart->where('product_id', $product_id)
    //         ->where('user_id', $user_id)
    //         ->first();
    
    //     if ($existingCartItem) {
    //         // If the item is already in the cart, update the quantity
    //         $existingCartItem->qty += $qty; // Add the new quantity to the existing one
    //         $cart->update($existingCartItem->id, [
    //             'qty' => $existingCartItem->qty,
    //         ]);
    
    //         return redirect()->back()->with('success', $product['name'] . " quantity updated in your cart.");
    //     } else {
    //         // If the item is not in the cart, create a new cart entry
    //         $cart->insert([
    //             'product_id' => $product_id,
    //             'user_id' => $user_id,
    //             'qty' => $qty,
    //         ]);
    
    //         return redirect()->back()->with('success', $product['name'] . " added to your cart.");
    //     }
    // }
    
    // Add product to cart
    // public function add($productId)
    // {
    //     $userId = session()->get('user_id');

    //     // Check if the product exists
    //     $product = $this->product->find($productId);
    //     if (!$product) {
    //         return redirect()->back()->with('error', 'Product not found');
    //     }

    //     // Check if the product is already in the cart
    //     $cartItem = $this->cart->where(['user_id' => $userId, 'product_id' => $productId])->first();

    //     if ($cartItem) {
    //         // Update quantity if it already exists
    //         $this->cart->update($cartItem['id'], [
    //             'quantity' => $cartItem['quantity'] + 1,
    //         ]);
    //     } else {
    //         // Add new item to cart
    //         $this->cart->insert([
    //             'user_id' => $userId,
    //             'product_id' => $productId,
    //             'quantity' => 1,
    //         ]);
    //     }

    //     return redirect()->to('/cart')->with('success', 'Product added to cart');
    // }

    // Update cart item quantity
    public function increaseQuantity($cart_item_id, $amount = 1)
    {
        $cart = new Cart();
        $existingCartItem = $cart->find($cart_item_id); // Retrieve the existing cart item
    
        if ($existingCartItem) {
            $newQty = $existingCartItem['quantity'] + $amount;
    
            // Update the quantity in the cart
            $cart->update($cart_item_id, ['quantity' => $newQty]);
    
            return redirect()->back()->with('success', 'Quantity increased in your cart.');
        } else {
            return redirect()->back()->with('error', 'Item not found in your cart.');
        }
    }

    public function decreaseQuantity($cart_item_id, $amount = 1)
{
    $cart = new Cart();
    $existingCartItem = $cart->find($cart_item_id); // Retrieve the existing cart item

    if ($existingCartItem) {
        $newQty = $existingCartItem['quantity'] - $amount;

        if ($newQty < 1) {
            // Optionally remove item if quantity is zero or less
            $cart->delete($cart_item_id);
            return redirect()->back()->with('success', 'Item removed from your cart.');
        } else {
            // Update the quantity in the cart
            $cart->update($cart_item_id, ['quantity' => $newQty]);
            return redirect()->back()->with('success', 'Quantity decreased in your cart.');
        }
    } else {
        return redirect()->back()->with('error', 'Item not found in your cart.');
    }
}

    
    // Method to remove a specific item from the cart
    public function remove($productId)
    {
        $userId = session()->get('user')['id']; // Get the logged-in user ID

        // Call the model method to remove the cart item
        if ($this->cart->removeCartItem($userId, $productId)) {
            return redirect()->to('/cart_screen')->with('success', 'Item removed from cart successfully.');
        } else {
            return redirect()->to('/cart_screen')->with('error', 'Failed to remove item from cart.');
        }
    }

    // Method to clear the entire cart for the user
    public function clear()
    {
        $userId = session()->get('user')['id']; // Get the logged-in user ID

        // dd($this->cart->clearCart($userId));

        // Call the model method to clear the cart
        if ($this->cart->clearCart($userId)) {
            return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
        } else {
            return redirect()->to('/cart_screen')->with('error', 'Failed to clear cart.');
        }
    }
    
}
