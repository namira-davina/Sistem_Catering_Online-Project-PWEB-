<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Delivery Status - DeliziaHome</title>
    <link rel="stylesheet" href="/css/delivery_status.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">DELIZIAHOME</div>
        <nav>
            <a href="<?= base_url('user/home') ?>">Home</a>
            <a href="<?= base_url('user/menu') ?>">Menu</a>
            <a href="<?= base_url('user/profile') ?>">Profile</a>
            <button onclick="location.href='<?= base_url('logout') ?>'">Log Out</button>
        </nav>
    </header>

    <div class="container-wrapper">

        <div class="delivery-container">
            <div class="delivery-header">
                <div class="order-id">
                    <i class="fas fa-receipt"></i>
                    <span>Order #<?= $order['id'] ?? 'ORD-001' ?></span>
                </div>
            </div>

            <div class="delivery-illustration">
                <div class="illustration-container">
                    <img src="<?= base_url('images/delivery.png') ?>" alt="Delivery Tracking" class="delivery-image">
                </div>
            </div>

            <div class="delivery-message">
                <h1>Your Food is On Its Way!</h1>
                <p class="delivery-subtitle">
                    Our delivery partner is bringing your delicious meal to your doorstep.
                </p>
            </div>

            <div class="delivery-info">
                <h2>Delivery Information</h2>
                
                <div class="info-grid">
                    <div class="info-card">
                        <div class="card-icon address">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="card-content">
                            <h3>Delivery Address</h3>
                            <p><?= esc($order['address']) ?></p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="card-icon driver">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-content">
                            <h3>Driver Contact</h3>
                            <p><?= esc($driverContact ?? 'Driver will contact you') ?></p>
                            <div class="contact-actions">
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $driverContact) ?>" class="contact-btn whatsapp">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                
                <a href="<?= base_url('user/order/mark-delivered/' . $order['id']) ?>" class="btn btn-complete">
                    Selesai
                </a>
                <a href="<?= base_url('user/order/status/' . $order['id']) ?>" class="btn btn-secondary">
                    View Order Details
                </a>
                <a href="<?= base_url('user/home') ?>" class="btn btn-outline">
                    Back to Home
                </a>
            </div>
        </div>
    </div>

</body>
</html>