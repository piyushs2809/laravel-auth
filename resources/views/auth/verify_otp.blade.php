<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
<meta http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="Sat, 01 Jan 2000 00:00:00 GMT">

    <title>Verify Your Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-4 p-4 border rounded shadow">
            <!-- Show Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        <h2 class="text-center mb-4">Verify Your Account</h2>
        <p class="text-center">Enter the 4-digit OTP sent to your email.</p>

        <form action="{{ route('verify.otp') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ request()->email }}">

            <div class="mb-3">
                <label class="form-label">Enter OTP</label>
                <input type="text" class="form-control" name="verification_code" placeholder="Enter OTP" required>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100">Verify</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
