<html>

<head>
    <title>grocery index</title>
    <link rel="stylesheet" href="/Grocery_App/Client_Grocery_App/app/css/style.css">
</head>

<body>
    <span style="color: green"><?php echo isset($data['message']) ? $data['message'] : "" ?></span>
    <span style="color: red"><?php echo isset($data['error']) ? $data['error'] : "" ?></span>
    <div class="display-flex" style="justify-content: space-evenly; align-items: center; height: 100%; width: 80%; justify-self: center">
        <div class="display-flex" style="background: rgba(255,255,255,0.3)">
            <?php include('login.php'); ?>
        </div>
        <div class="display-flex">
            <?php include('register.php'); ?>
        </div>
    </div>

</body>

</html>