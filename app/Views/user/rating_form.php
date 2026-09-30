<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rate Your Order - DeliziaHome</title>
    <link rel="stylesheet" href="/css/rating_form.css">
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
    <div class="rating-container">

        <div class="rating-header">
            <div class="order-id">
                <i class="fas fa-receipt"></i>
                <span>Order #<?= $order['id'] ?? 'ORD-001' ?></span>
            </div>
        </div>

        <div class="rating-illustration">
            <div class="illustration-container">
                <img src="<?= base_url('images/selesai.png') ?>" alt="Order Completed" class="rating-image">
            </div>
        </div>

        <div class="rating-message">
            <h1>Thank You for Your Order!</h1>
            <p class="rating-subtitle">
                Your order has been successfully delivered. We'd love to hear about your experience!
            </p>
        </div>

        <form action="<?= base_url('user/order/rating/submit/' . $order['id']) ?>" method="post" class="rating-form">
            <?= csrf_field() ?>

            <div class="rating-section">
                <h2><i class="fas fa-star"></i> Rate Your Experience</h2>
                <p class="section-subtitle">How would you rate your overall experience?</p>
                
                <div class="star-rating">
                    <input type="radio" name="rating" id="star5" value="5">
                    <label for="star5" class="star-label">
                        <i class="fas fa-star"></i>
                        <span class="star-text">Excellent</span>
                    </label>
                    
                    <input type="radio" name="rating" id="star4" value="4">
                    <label for="star4" class="star-label">
                        <i class="fas fa-star"></i>
                        <span class="star-text">Very Good</span>
                    </label>
                    
                    <input type="radio" name="rating" id="star3" value="3" checked>
                    <label for="star3" class="star-label">
                        <i class="fas fa-star"></i>
                        <span class="star-text">Good</span>
                    </label>
                    
                    <input type="radio" name="rating" id="star2" value="2">
                    <label for="star2" class="star-label">
                        <i class="fas fa-star"></i>
                        <span class="star-text">Fair</span>
                    </label>
                    
                    <input type="radio" name="rating" id="star1" value="1">
                    <label for="star1" class="star-label">
                        <i class="fas fa-star"></i>
                        <span class="star-text">Poor</span>
                    </label>
                </div>
            </div>

            <div class="feedback-section">
                <h2><i class="fas fa-comment-alt"></i> Your Feedback</h2>
                <p class="section-subtitle">Share your thoughts to help us improve</p>

                <div class="message-box">
                    <textarea 
                        id="message" 
                        name="message" 
                        placeholder="Tell us more about your experience. What did you like? What can we improve?"
                        rows="4"
                        class="message-input"></textarea>
                </div>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn btn-submit">
                    Submit Review
                </button>
                <a href="<?= base_url('user/home') ?>" class="btn btn-skip">
                    Skip for Now
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>