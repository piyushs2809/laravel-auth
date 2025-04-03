<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-4 p-4 border rounded shadow text-center">
        <div class="row g-2">
            <div class="col">
                <a href="{{ route('customer.registrationPage') }}" class="btn btn-success w-100">Customer</a>
            </div>
            <div class="col">
                <a href="{{ route('admin.registrationPage') }}" class="btn btn-info w-100">Admin</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
