<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="text-center">
            <div class="mb-4">
                <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
            </div>
            <h1 class="mb-3">Order Placed Successfully!</h1>
            <p class="lead mb-4">Thank you for your order. We've received it and will process it shortly.</p>
            <a href="{{ route('customer.order') }}" class="btn btn-primary px-4">
                <i class="fas fa-arrow-left me-2"></i> Back to Shopping
            </a>
        </div>
    </div>
</body>
</html>