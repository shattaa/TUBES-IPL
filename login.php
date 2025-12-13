<?php
session_start();
require "config/database.php";

// Tangani pesan logout
$message = "";
if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Proses login
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if($data && $password == $data['password']) {
        $_SESSION['login'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e9edf6;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        .login-box {
            width: 350px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            z-index: 1;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #444;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background: #005dc1;
        }

        .toast {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 14px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease, top 0.5s ease;
            z-index: 999;
        }

        .toast.show {
            opacity: 1;
            top: 40px;
            pointer-events: auto;
        }

        .error {
            margin-top: 10px;
            background: #ffdddd;
            padding: 10px;
            border-left: 4px solid #c00;
            color: #c00;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<?php if(!empty($message)): ?>
    <div class="toast" id="toast"><?= $message ?></div>
<?php endif; ?>

<div class="login-box">
    <h2>📚 Login Perpustakaan</h2>

    <?php if(isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>
</div>

<script>
    // Tampilkan toast jika ada
    const toast = document.getElementById('toast');
    if(toast){
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000); // hilang otomatis setelah 3 detik
    }
</script>

</body>
</html>
