<html>

<head>
    <title>grocery index</title>
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap');
    body {
        /*background-image: url(../pictures/bgWallpaper.jpg);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;*/
        margin: 0;
        width: 100vw;
        height: 100vh;
        background: /*#ecf0f3*/#ECEFF4;
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center;
        place-items: center;
        overflow: hidden;
        font-family: poppins;
    }

    .container{
      position: static;
      width: 350px;
      height: 1000px;
      display: flex;
      border-radius: 20px;
      padding: 40px;
      box-sizing: border-box;
      background: #ecf0f3;
      box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
  }

  .logo {
    position: relative;
    top: -250px;
    left: 70px;
    height: 150px;
      width: 2000px;
      background-image: url(../pictures/appIcon.png);
      background-repeat: no-repeat;
        background-position: center;
        background-size: 450px 350px;
      margin: auto;
      border-radius: 50%;
      box-sizing: border-box;
      box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px white;
  }

  .title {
    position: relative;
    left: -60px;
  margin-top: 10px;
  font-weight: 900;
  font-size: 1.6rem;
  color: #1DA1F2;
  letter-spacing: 1px;
}


</style>
<<link rel="stylesheet" href="/Grocery_App/Client_Grocery_App/app/css/style.css">
</head>

<body id="indexBody">

    <div class="container">
        <div class="logo"></div>
        <div class="title">SHOPPING APP</div>
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

    </div>

</body>

</html>