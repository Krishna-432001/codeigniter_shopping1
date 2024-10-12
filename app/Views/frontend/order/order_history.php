<h1>Order History</h1>

<?php if (!empty($orders)): ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['total_price'] ?></td>
                <td><?= $order['status'] ?></td>
                <td><?= $order['created_at'] ?></td>
                <td><a href="<?= base_url('frontend/order/detail/' . $order['id']) ?>">View Details</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>
