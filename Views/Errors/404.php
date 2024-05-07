<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>404 Not Found</title>
</head>
<style>
    body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    background-color: #f8f9fa;
}

.error-container {
    text-align: center;
    background-color: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.number {
    font-size: 120px;
    color: #e44d26;
    font-weight: bold;
}

.text {
    font-size: 24px;
    color: #333;
    margin-top: 10px;
}

p {
    font-size: 16px;
    color: #555;
    margin-top: 20px;
}

a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #2980b9;
}

</style>
<body>
    <div class="error-container">
        <div class="number">404</div>
        <div class="text">Oops! Page not found.</div>
        <p>The page you are looking for might have been removed or temporarily unavailable.</p>
    </div>
    <script src="script.js"></script>
</body>
</html>
