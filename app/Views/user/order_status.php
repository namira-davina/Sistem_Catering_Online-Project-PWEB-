<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order Status - DeliziaHome</title>
    <link rel="stylesheet" href="/css/order_status.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header>
    <div class="logo">DELIZIAHOME</div>
    <nav>
        <a href="<?= base_url('user/home') ?>">Home</a>
        <a href="<?= base_url('user/menu') ?>">Menu</a>
        <a href="<?= base_url('user/profile') ?>">Profile</a>
        <button onclick="location.href='<?= base_url('/logout') ?>'">Log Out</button>
    </nav>
</header>

<div class="container-wrapper">
    <div class="order-status-container">
        <div class="order-header">
            <div class="order-id">
                <i class="fas fa-receipt"></i>
                <span>Order #<?= $order['id'] ?? 'ORD-001' ?></span>
            </div>
        </div>

        <div class="status-illustration">
            <div class="illustration-container">
                <img src="<?= base_url('images/food_status.png') ?>" alt="Food Preparation" class="status-image">
            </div>
        </div>

        <div class="status-message">
            <h1>Your Order is Being Prepared</h1>
            <p class="status-subtitle">
                Our talented chefs are crafting your delicious meal with fresh ingredients.
            </p>
        </div>

        <div class="order-details">
            <h2>Order Information</h2>
            
            <div class="details-grid">
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="detail-content">
                        <h4>Customer</h4>
                        <p><?= esc($order['name'] ?? 'Customer Name') ?></p>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="detail-content">
                        <h4>Phone</h4>
                        <p><?= esc($order['mobile'] ?? 'Phone Number') ?></p>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="detail-content">
                        <h4>Delivery Address</h4>
                        <p><?= esc($order['address'] ?? 'Delivery Address') ?></p>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="detail-content">
                        <h4>Payment Method</h4>
                        <p><?= esc($order['payment_method'] ?? 'Payment Method') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <?php if ($order['status'] == 'diantar') : ?>
                <a href="<?= base_url('user/order/delivery/' . $order['id']) ?>" class="btn btn-primary">
                    Track Delivery Status
                </a>
            <?php else : ?>
                <button class="btn btn-primary" disabled style="opacity:0.5; cursor:not-allowed;">
                    Pesanan masih dibuat
                </button>
            <?php endif; ?>

            <a href="<?= base_url('user/menu') ?>" class="btn btn-secondary">
                Order More Food
            </a>
            <a href="<?= base_url('user/home') ?>" class="btn btn-outline">
                Back to Home
            </a>
        </div>
    </div>
</div>

</body>
</html>