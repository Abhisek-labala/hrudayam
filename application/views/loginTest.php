<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>res Hridayam Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    /* body {
      background: #e6f3fb;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    } */

    body {
      background: #e6f3fb url('https://doctor.tasainnovation.com/13732.jpg') center center no-repeat;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .container {
      display: flex;
      width: 100%;
      max-width: 900px;
      height: auto;
      background-color: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      flex-direction: row;
    }

    .left,
    .right {
      flex: 1;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .left {
      background: linear-gradient(135deg, #1d3557, #6c0636);
      color: white;
      text-align: center;
    }

    .left img {
        width: 140px;
        margin-bottom: 30px;
        text-align: center;
        margin: 105px;
    }

    .left h1 {
      font-size: 32px;
    }

    .left p {
      margin-top: 20px;
      font-size: 14px;
      line-height: 1.5;
    }

    .right h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #1d3557;
    }

    .input-box {
      position: relative;
      margin-bottom: 20px;
    }

    .input-box input {
      width: 100%;
      padding: 12px 40px;
      border-radius: 8px;
      border: none;
      background-color: #eaf4fb;
    }

    .input-box i {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #1d3557;
    }

    .options {
      display: flex;
      justify-content: space-between;
      margin: 10px 0 20px;
      font-size: 14px;
      color: #555;
    }

    .login-btn {
      background: linear-gradient(to right, #2d2d75, #c42942);
      color: white;
      padding: 12px;
      border: none;
      width: 100%;
      border-radius: 20px;
      cursor: pointer;
      font-weight: bold;
    }

    .signup {
      text-align: center;
      margin-top: 20px;
      color: #1d3557;
      font-size: 14px;
    }

    .signup a {
      color: #c42942;
      text-decoration: none;
    }

    .dots {
      text-align: center;
      font-size: 24px;
      color: #ccc;
      margin-top: 10px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        height: auto;
        border-radius: 15px;
      }

      .left,
      .right {
        padding: 40px 20px;
        text-align: center;
      }

      .left img {
        margin: 0 auto 20px;
      }

      .input-box input {
        padding: 12px 16px 12px 36px;
      }

      .options {
        flex-direction: column;
        align-items: center;
        gap: 10px;
      }

      .options label {
        margin: 0;
      }
    }

    @media (max-width: 480px) {
      .left h1 {
        font-size: 24px;
      }

      .left p {
        font-size: 13px;
      }

      .right h2 {
        font-size: 20px;
      }

      .login-btn {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <!-- <img src="https://i.ibb.co/MDBB29Z/hridayam-logo.png" alt="Hridayam Logo"> -->
      <img src="https://doctor.tasainnovation.com//uploads/logo.png" alt="Hridayam Logo">      
      <h1>Hello <br><strong>Welcome!</strong></h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam</p>
    </div>
    <div class="right">
      <h2>LOGIN</h2>
          <form id="loginForm"  method="post" action="<?php echo base_url()?>Educator-login-Post"  onsubmit="return validateLogin();">
          <div class="input-box">
          <input type="text" id="email" name="email" placeholder="Email">
          </div>
          <div class="input-box">
          <input type="password" id="password" name="password" placeholder="Password">
          </div>
          <div class="options">
          <label><input type="checkbox"> Remember</label>
          </div>
          <button class="login-btn" type="submit">Login</button>
          <div class="signup">Sign up!</div>
          <div class="dots">● ● ●</div>
          </form>
    </div>
  </div>
</body>
</html>


<script>
  function validateLogin() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === '') {
      alert('Please enter your Email.');
      document.getElementById('email').focus();
      return false;
    }

    if (!emailRegex.test(email)) {
      alert('Please enter a valid Email address.');
      document.getElementById('email').focus();
      return false;
    }

    if (password === '') {
      alert('Please enter your Password.');
      document.getElementById('password').focus();
      return false;
    }

    if (password.length < 6) {
      alert('Password must be at least 6 characters long.');
      document.getElementById('password').focus();
      return false;
    }

    return true; // All good
  }
</script>
