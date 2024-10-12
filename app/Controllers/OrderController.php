<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\OrderHistory;
use App\Models\Product;
use CodeIgniter\Controller;
use Razorpay\Api\Api;
use Endroid\QrCode\QrCode;

class OrderController extends BaseController
{
    protected $order;
    protected $orderItem;
    protected $orderHistory;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderItem = new OrderItems();
        $this->orderHistory = new OrderHistory();
    }

    // Show the checkout page with order details, address, and payment options
    public function checkout($productId) // Change to accept productId as a parameter
    {
        // Load product model
        $products = new Product(); 
        $product = $products->find($productId);
    
        if (!$product) {
            return redirect()->to('/')->with('error', 'Product not found.');
        }
    
        // Initialize Razorpay API
        $api = new Api('your_razorpay_key', 'your_razorpay_secret');
    
        // Create an order in Razorpay
        $orderData = [
            'amount' => $product['price'] * 100, // Amount in paise
            'currency' => 'INR',
            'payment_capture' => 1, 
        ];
    
        try {
            $order = $api->order->create($orderData);
        } catch (Exception $e) {
            return redirect()->to('/')->with('error', 'Unable to create order. Please try again.');
        }
    
        return view('frontend/order/checkout', [
            'product' => $product,
            'order_id' => $order['id'],
            'user_email' => session()->get('user_email'),
            'amount' => $order['amount'], 
        ]);
    }
    
    
    // Create a new order after form submission
    public function placeOrder()
    {
        $userId = session()->get('user_id');
        $address = $this->request->getPost('address');
        $phone = $this->request->getPost('phone');
        $paymentMethod = 'razorpay';

        if (!$this->validate([
            'address' => 'required',
            'phone' => 'required|numeric'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $cart = session()->get('cart');
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $orderData = [
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'address' => $address,
            'phone' => $phone,
            'payment_method' => $paymentMethod,
            'status' => 'pending',
        ];

        $orderId = $this->order->insert($orderData);

        foreach ($cart as $item) {
            $orderItemData = [
                'order_id' => $orderId,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];

            $this->orderItem->insert($orderItemData);
        }

        session()->remove('cart');

        return redirect()->to(base_url('order/payment/' . $orderId));
    }

    // Razorpay Payment Page
    public function payment($orderId)
    {
        $order = $this->order->find($orderId);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        return view('frontend/order/payment', ['order' => $order]);
    }

    // Handle successful payment
    public function paymentSuccess($orderId)
    {
        $this->order->update($orderId, ['status' => 'completed']);

        $this->orderHistory->insert([
            'order_id' => $orderId,
            'status' => 'completed',
            'comment' => 'Payment completed via Razorpay'
        ]);

        return redirect()->to(base_url('order/success/' . $orderId));
    }

    // Handle order success page
    public function success($orderId)
    {
        $order = $this->order->find($orderId);
    
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }
    
        return view('frontend/order/success', ['order' => $order]);
    }
    

    // View order history
    
    public function order_history()
    {
        // Get the user ID from session
        $user_id = session()->get('user_id');
        
        // Fetch all orders for this user
        $orders = $this->order->where('user_id', $user_id)->findAll();
    
        // Load the order history view
        return view('frontend/order/order_history', ['orders' => $orders]);
    }

    // View order details
    public function orderDetail($orderId)
    {
        // Find the order and related items
        $order = $this->order->find($orderId);
        $orderItems = $this->orderItem->where('order_id', $orderId)->findAll();
    
        // Load the order detail view
        return view('frontend/order/detail', [
            'order' => $order,
            'orderItems' => $orderItems
        ]);
    }
    

    // Generate QR code for UPI payment
    public function generateQrCode($upiId, $amount)
    {
        $qrCode = new QrCode("upi://pay?pa=$upiId&am=$amount&cu=INR&tn=Payment for Order");
        $filePath = FCPATH . 'uploads/qr_codes/payment_qr_' . time() . '.png'; 
        $qrCode->writeFile($filePath);

        return base_url('uploads/qr_codes/payment_qr_' . time() . '.png'); 
    }

    // Process Razorpay payment
    // public function processPayment()
    // {
    //     $response = $this->request->getPost();

    //     $api = new Api('your_razorpay_key', 'your_razorpay_secret'); 
    //     $attributes = [
    //         'razorpay_order_id' => $response['razorpay_order_id'],
    //         'razorpay_payment_id' => $response['razorpay_payment_id'],
    //         'razorpay_signature' => $response['razorpay_signature']
    //     ];

    //     try {
    //         $api->utility->verifyPaymentSignature($attributes);

    //         $orderData = [
    //             'user_id' => session()->get('user_id'), 
    //             'amount' => $response['amount'], 
    //             'address' => $response['address'],
    //             'phone' => $response['phone'],
    //             'payment_id' => $response['razorpay_payment_id'],
    //             'status' => 'completed', 
    //             'created_at' => date('Y-m-d H:i:s')
    //         ];

    //         $this->order->insert($orderData);

    //         return redirect()->to('/order/success')->with('success', 'Payment successful and order placed!');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Payment verification failed: ' . $e->getMessage());
    //     }
    // }

    // View order details
    public function view($orderId)
    {
        $order = $this->order->find($orderId);
        $orderItems = $this->orderItem->where('order_id', $orderId)->findAll();
        $orderHistory = $this->orderHistory->where('order_id', $orderId)->findAll();

        return view('frontend/order/view', [
            'order' => $order,
            'orderItems' => $orderItems,
            'orderHistory' => $orderHistory
        ]);
    }

    public function confirmation($productId) // Change to accept productId as a parameter
    {
        // Load product model
        $products = new Product(); 
        $product = $products->find($productId);

        $data = [
            'product' => $product,  // Ensure this is correctly defined
            // 'order_id' => $order['id'],
            'user_email' => session()->get('user_email'),
            // 'amount' => $order['amount'], 
        ];

        // dd($data);
        return view('frontend/order/confirmation', $data);
    }

    // Method to create an order
    public function createRazorpayOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            // You can add more validations as needed
        ]);

        // Load the product model
        $product = Product::findOrFail($request->product_id);

        // Initialize Razorpay API
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_SECRET_KEY'));

        // Create an order
        $orderData = [
            'amount' => $product->price * 100, // Amount in paise
            'currency' => 'INR',
            'receipt' => 'receipt#' . time(), // Unique receipt ID
        ];

        try {
            $order = $api->order->create($orderData);

            // Return the order ID and product details to the view
            return view('frontend.order.checkout', [
                'order_id' => $order->id,
                'product' => $product,
                'user_email' => session()->get('user_email'),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating order: ' . $e->getMessage());
        }
    }

    // Method to handle payment processing
    public function processPayment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'order_id' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            // Add more validations as needed
        ]);

        // You can add payment verification logic here

        // Redirect to confirmation page with success message
        return redirect()->route('order.confirmation', ['productId' => $request->product_id])
                         ->with('success', 'Payment successful! Your order has been placed.');
    }
}
