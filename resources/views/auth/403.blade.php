<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/564/564619.png" type="image/png">
    <title>403 Forbidden</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Dark Web CLI Style */
        body {
            background: #000; /* Dark background */
            color: #00ff00; /* Greenish text like a terminal */
            font-family: 'Courier New', Courier, monospace; /* Monospaced font for terminal look */
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Error container styling */
        .error-container {
            background: rgba(0, 0, 0, 0.9); /* Darker background for the error box */
            padding: 50px 80px;
            border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.8);
            text-align: center;
            width: 100%;
            max-width: 700px;
        }

        /* Error code styling */
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #ff0000; /* Red color for error */
            text-shadow: 0 5px 10px rgba(0, 0, 0, 0.8);
            margin-bottom: 30px;
        }

        /* Error message styling */
        .error-message {
            font-size: 1.3rem;
            color: #66ff66; /* Light green text */
            margin-bottom: 30px;
            font-weight: 400;
        }

        /* Button styling */
        .btn-home {
            font-size: 1.1rem;
            padding: 12px 30px;
            background: #222222; /* Dark gray background */
            color: #00ff00; /* Green color */
            border: 2px solid #00ff00;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        /* Button hover effect */
        .btn-home:hover {
            background: #00ff00; /* Green background on hover */
            color: #222222; /* Dark text on hover */
            border: 2px solid #00ff00;
            transform: translateY(-2px);
        }

        /* Illustration styling */
        .illustration {
            max-width: 100px;
            margin-bottom: 20px;
            opacity: 0.7;
            transition: opacity 0.5s ease;
        }

        .illustration:hover {
            opacity: 1;
        }

    </style>
</head>

<body>
    <div class="error-container">
        <img src="https://cdn-icons-png.flaticon.com/512/564/564619.png" alt="Forbidden" class="illustration">
        <div class="error-code">403</div>
        <p class="error-message">Akses Ditolak!!</p>
        <p class="error-message">Oops! Anda tidak memiliki akses untuk halaman ini.</p>
        <a href="{{ url('/') }}" class="btn btn-primary btn-home">Kembali ke Beranda</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



