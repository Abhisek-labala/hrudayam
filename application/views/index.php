<!DOCTYPE html>
<html lang="en">
<head>
<?php 
include('head.php');
?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hridayam</title>
  <link rel="icon" href="https://doctor.tasainnovation.com/uploads/logo.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }
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
      margin-left: -14px;
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
      border: 1px solid #e9e9e9;
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
	.role-buttons {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  justify-items: center;
  margin-top: 40px;
}

.role-btn {
  background: linear-gradient(135deg, #c42942, #1d3557);
  color: #fff;
  text-align: center;
  text-decoration: none;
  border: none;
  padding: 12px 24px;
  border-radius: 12px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  width: 200px;
  transition: transform 0.2s ease, opacity 0.3s ease;
  display: inline-block;
}

.role-btn:hover {
  transform: scale(1.05);
  opacity: 0.95;
}

@media (max-width: 480px) {
  .role-buttons {
    grid-template-columns: 1fr;
  }
}
.right h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #1d3557;
  font-size: 22px;
}

  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <!-- <img src="https://i.ibb.co/MDBB29Z/hridayam-logo.png" alt="Hridayam Logo"> -->
      <img src="https://doctor.tasainnovation.com//uploads/logo.png" alt="Hridayam Logo">      
      <h1>Hello <br><strong>Welcome!</strong></h1>
      <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam</p>-->
    </div>
    <div class="right">
  <div class="role-buttons">
    <a href="https://hridayampsp.com/educator-login" class="role-btn">Educator</a>
    <a href="https://hridayampsp.com/Digital-Educator-login" class="role-btn">Digital Educator</a>
    <a href="https://hridayampsp.com/Digital-YogaDieticial-login" class="role-btn">Digital Yoga Dietician</a>
    <a href="https://hridayampsp.com/rm-login" class="role-btn">RM</a>
    <a href="https://hridayampsp.com/mis-login" class="role-btn">MIS</a>
    <a href="https://hridayampsp.com/pm-login" class="role-btn">PM</a>
  </div>
</div>

  </div>
</body>
</html>
