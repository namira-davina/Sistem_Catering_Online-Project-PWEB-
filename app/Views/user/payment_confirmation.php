<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Payment Confirmation - DeliziaHome</title>
    <link rel="stylesheet" href="/css/payment_confirmation.css">
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

    <div class="main-container">
        <div class="payment-detail">
            <div class="detail-header">
                <h3><i class="fas fa-receipt"></i> Payment Details</h3>
            </div>

            <div class="detail-body">
                <div class="detail-section">
                    <h4><i class="fas fa-shopping-cart"></i> Order Summary</h4>
                    <div class="row">
                        <span>Menu Items</span>
                        <span><?= $jumlah_paket ?> package(s)</span>
                    </div>
                    <div class="row">
                        <span>Price per Package</span>
                        <span>Rp <?= number_format($subtotal / $jumlah_paket, 0, ',', '.') ?></span>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-calculator"></i> Payment Breakdown</h4>
                    <div class="row">
                        <span>Subtotal</span>
                        <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>
                </div>

                <div class="total-section">
                    <div class="row total">
                        <span>TOTAL AMOUNT</span>
                        <span class="total-amount">Rp <?= number_format($total, 0, ',', '.') ?></span>
                    </div>
                </div>

                <a href="<?= base_url('user/order/confirmPayment/' . $order['id']) ?>" class="btn-paid">
                    Confirm Payment
                </a>
            </div>
        </div>

        <div class="qr-section">
            <div class="qr-header">
                <h2>SCAN TO PAY</h2>
                <div class="qr-status">
                    <span class="status-text">Ready to Scan</span>
                </div>
            </div>
                <div class="qr-frame">
                    <img src="<?= base_url('images/sample-qrcode.jpg') ?>" alt="QR Code Payment" class="qr-image">
                </div>
        
        </div>
    </div>
</div>

</body>
</html>