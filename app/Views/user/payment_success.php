<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Payment Successful - DeliziaHome</title>
    <link rel="stylesheet" href="/css/payment_success.css">
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
    <div class="success-wrapper">

        <div class="success-card">
            <div class="success-icon">
                <div class="icon-circle">
                    <i class="fas fa-check"></i>
                </div>
            </div>

            <h1 class="success-title">
                Payment Successful!
            </h1>
            
            <p class="success-subtitle">
                Thank you for your order. Your payment has been confirmed.
            </p>

            <div class="order-id-badge">
                <i class="fas fa-receipt"></i>
                Order #<?= $order['id'] ?? 'ORD-001' ?>
            </div>

            <div class="order-summary">
                <h3><i class="fas fa-clipboard-list"></i> Order Details</h3>
                
                <div class="summary-grid">
                    <div class="summary-item">
                        <span class="label"><i class="fas fa-user"></i> Customer Name</span>
                        <span class="value"><?= esc($order['name']) ?></span>
                    </div>
                    <div class="summary-item">
                        <span class="label"><i class="fas fa-phone"></i> Phone Number</span>
                        <span class="value"><?= esc($order['mobile']) ?></span>
                    </div>
                    <div class="summary-item full-width">
                        <span class="label"><i class="fas fa-map-marker-alt"></i> Delivery Address</span>
                        <span class="value"><?= esc($order['address']) ?></span>
                    </div>
                    <div class="summary-item">
                        <span class="label"><i class="fas fa-credit-card"></i> Payment Method</span>
                        <span class="value"><?= esc($order['payment_method'] ?? 'QRIS') ?></span>
                    </div>
                </div>

                <div class="total-amount">
                    <div class="total-label">Total Amount</div>
                    <div class="total-value">Rp <?= number_format($total, 0, ',', '.') ?></div>
                </div>
            </div>

            <div class="action-buttons">
                <?php if ($order['status'] != 'pending'): ?>
                    <a href="<?= base_url('user/order/status/' . $order['id']) ?>" class="btn-primary">
                        <i class="fas fa-eye"></i> Track Order Status
                    </a>
                <?php else: ?>
                    <button class="btn-primary" style="opacity:0.5; cursor:not-allowed;" disabled>
                        <i class="fas fa-eye"></i> Pending
                    </button>
                <?php endif; ?>

                <a href="<?= base_url('user/menu') ?>" class="btn-secondary">
                    <i class="fas fa-utensils"></i> Order Again
                </a>
                <a href="<?= base_url('user/home') ?>" class="btn-outline">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>