<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Read2earn Password Reset</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }
  .email-wrapper {
    max-width: 600px;
    margin: 20px auto;
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }
  .header {
    background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
    padding: 30px 20px;
    text-align: center;
  }
  .header h1 {
    color: #ffffff;
    margin: 0;
    font-weight: 300;
    letter-spacing: 1px;
  }
  .content {
    padding: 30px;
  }
  h2 {
    color: #2e7d32;
    font-weight: 500;
    margin-top: 0;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
  }
  p {
    color: #555;
    font-size: 16px;
    margin-bottom: 20px;
  }
  .btn {
    display: inline-block;
    background-color: #2e7d32;
    color: #fff;
    text-decoration: none;
    padding: 12px 30px;
    border-radius: 4px;
    font-weight: 500;
    margin: 15px 0;
  }
  .security-tips {
    background-color: #f1f8e9;
    padding: 20px;
    border-radius: 6px;
    border-left: 4px solid #2e7d32;
    margin: 20px 0;
  }
  .security-tips h3 {
    color: #2e7d32;
    margin-top: 0;
  }
  ul {
    padding-left: 20px;
  }
  li {
    color: #555;
    margin-bottom: 8px;
  }
  .footer {
    background-color: #f1f8e9;
    padding: 20px;
    text-align: center;
    border-top: 1px solid #eee;
  }
  .footer p {
    font-size: 14px;
    color: #777;
    margin: 0;
  }
  .tagline {
    font-weight: bold;
    color: #2e7d32;
    font-size: 16px;
    margin-top: 25px;
    text-align: center;
  }
  .logo-accent {
    font-weight: 700;
  }
  .button-container {
    text-align: center;
    margin: 25px 0;
  }
</style>
</head>
<body>
  <div class="email-wrapper">
    <div class="header">
      <h1>PaidReader.app</h1>
    </div>
    
    <div class="content">
      <h2>Password Reset Request</h2>
      
      <p>Hello {{ $user->name }},</p>
      
      <p>You're receiving this email because you've requested to reset your password for your PaidReader.app account. To ensure the security of your account, please follow the instructions below to reset your password.</p>
      
      <a href="{{ route('passwordresetpage', ['token' => $token]) }}" target="_blank" 
   style="display: inline-block; background-color: #2e7d32; color: #ffffff !important; 
   text-decoration: none; padding: 12px 30px; border-radius: 4px; font-weight: 500; 
   margin: 15px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Reset Password</a>
      
      <p>If you didn't request this password reset or believe it's an error, please ignore this email. Your account security is important to us, and no action is required.</p>
      
      <div class="security-tips">
        <h3>Security Recommendations</h3>
        <ul>
          <li>Your new password should be unique and not easily guessable.</li>
          <li>Avoid using commonly used passwords or personal information.</li>
          <li>Keep your password confidential and don't share it with anyone.</li>
          <li>Consider using a password manager for enhanced security.</li>
        </ul>
      </div>
      
      <p class="tagline">Paidreader.app — #1 Website To Earn From Reading.</p>
    </div>
    
    <div class="footer">
      <p>© {{ date('Y') }} paidreader.app. All rights reserved.</p>
      <div style="margin-top: 15px;">
        <a href="https://paidreader.app/terms" style="color: #2e7d32; text-decoration: none; font-size: 13px; margin: 0 10px;">Terms</a>
        <a href="https://paidreader.app/privacy" style="color: #2e7d32; text-decoration: none; font-size: 13px; margin: 0 10px;">Privacy</a>
       
      </div>
    </div>
  </div>
</body>
</html>