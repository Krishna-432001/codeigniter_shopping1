<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderHistory;
use App\Models\Product;
use CodeIgniter\Controller;
use Razorpay\Api\Api; // Ensure you import Razorpay API
use Endroid\QrCode\QrCode;

class OrderController extends BaseController
{
    protected $order;
    protected $orderItem;
    protected $orderHistory;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderItem = new OrderItem();
        $this->orderHistory = new OrderHistory();
    }

    // Show the checkout page with order details, address, and payment options
    public function checkout($productId)
    {
        // Load product model
        $productModel = new Product(); // Assuming you have the correct model
        $product = $productModel->find($productId);

        // Initialize Razorpay API
        $api = new Api('your_razorpay_key', 'your_razorpay_secret'); // Replace with your actual keys

        // Create an order in Razorpay
        $orderData = [
            'amount' => $product['price'] * 100, // Amount in paise
            'currency' => 'INR',
            'payment_capture' => 1, // Auto-capture after payment
        ];

        $order = $api->order->create($orderData);

        // Pass order ID and product details to the view
        return view('checkout', [
            'product' => $product,
            'order_id' => $order['id'],
            'amount' => $order['amount'], // Amount in paise
        ]);
    }

    // Create a new order after form submission
    public function placeOrder()
    {
        // Get POST data (e.g., from a form)
        $userId = session()->get('user_id'); // Assuming you are using session to get logged-in user
        $address = $this->request->getPost('address');
        $phone = $this->request->getPost('phone');
        $paymentMethod = 'razorpay'; // Assume Razorpay payment method

        // Validate form data
        if (!$this->validate([
            'address' => 'required',
            'phone' => 'required|numeric'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Fetch products from cart
        $cart = session()->get('cart');
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Calculate total price
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Insert order data
        $orderData = [
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'address' => $address,
            'phone' => $phone,
            'payment_method' => $paymentMethod,
            'status' => 'pending',
        ];

        $orderId = $this->order->insert($orderData);

        // Insert order items
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

        // Clear the cart after placing the order
        session()->remove('cart');

        // Redirect to Razorpay payment page
        return redirect()->to(base_url('order/payment/' . $orderId));
    }

    // Razorpay Payment Page
    public function payment($orderId)
    {
        $order = $this->order->find($orderId);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Here you can add logic to integrate Razorpay and generate QR code, if needed
        return view('payment', ['order' => $order]);
    }

    // Handle successful payment
    public function paymentSuccess($orderId)
    {
        // Update order status to 'completed'
        $this->order->update($orderId, ['status' => 'completed']);

        // Insert order history for tracking
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

        return view('order_success', ['order' => $order]);
    }

    // View order history
    public function orderHistory()
    {
        $userId = session()->get('user_id');
        $orders = $this->order->where('user_id', $userId)->findAll();

        return view('order_history', ['orders' => $orders]);
    }

    // View order details
    public function orderDetail($orderId)
    {
        $order = $this->order->find($orderId);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $orderItems = $this->orderItem->where('order_id', $orderId)->findAll();
        return view('order_detail', ['order' => $order, 'orderItems' => $orderItems]);
    }

    // Generate QR code for UPI payment
    public function generateQrCode($upiId, $amount)
    {
        // Create a QR code with the UPI payment link
        $qrCode = new QrCode("upi://pay?pa=$upiId&am=$amount&cu=INR&tn=Payment for Order");
        $filePath = FCPATH . 'uploads/qr_codes/payment_qr_' . time() . '.png'; // Dynamic filename with timestamp
        $qrCode->writeFile($filePath); // Save the QR code as a PNG file

        return base_url('uploads/qr_codes/payment_qr_' . time() . '.png'); // Return the URL to the generated QR code
    }

    // Process Razorpay payment
    public function processPayment()
    {
        // Get the payment response from Razorpay
        $response = $this->request->getPost();

        // Initialize Razorpay API for verification
        $api = new Api('your_razorpay_key', 'your_razorpay_secret'); // Replace with your actual keys
        $attributes = [
            'razorpay_order_id' => $response['razorpay_order_id'],
            'razorpay_payment_id' => $response['razorpay_payment_id'],
            'razorpay_signature' => $response['razorpay_signature']
        ];

        try {
            // Verify the payment signature
            $api->utility->verifyPaymentSignature($attributes);

            // If verification is successful, proceed to save order details
            $orderData = [
                'user_id' => session()->get('user_id'), // Assuming you can retrieve the user ID
                'amount' => $response['amount'], // Amount in paise
                'address' => $response['address'],
                'phone' => $response['phone'],
                'payment_id' => $response['razorpay_payment_id'],
                'status' => 'completed', // Assuming you want to mark it as completed
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Save the order
            $this->order->insert($orderData);

            // Redirect to success page
            return redirect()->to('/order/success')->with('success', 'Payment successful and order placed!');
        } catch (\Exception $e) {
            // Handle payment verification failure
            return redirect()->back()->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
}
