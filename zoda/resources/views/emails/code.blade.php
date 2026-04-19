<!DOCTYPE html>
<html>
<head>
    <title>Password Change Verification - paidreader.app</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f9f9f9;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%); text-align: center; padding: 30px 20px;">
            <h1 style="color: #ffffff; margin: 0; font-weight: 300; letter-spacing: 1px;">PaidReader.app</h1>
        </div>
        
        <!-- Content -->
        <div style="padding: 30px;">
            <h2 style="color: #2e7d32; font-weight: 500; margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 10px;">Password Change Request</h2>
            
            <p style="color: #555; font-size: 16px;">Hello,</p>
            
            <p style="color: #555; font-size: 16px;">You've requested to change your password on <strong style="color: #2e7d32;">paidreader.app</strong>. To proceed, please use the verification code below:</p>
            
            <div style="text-align: center; margin: 30px 0; background-color: #f1f8e9; padding: 20px; border-radius: 6px; border-left: 4px solid #2e7d32;">
                <p style="font-size: 32px; font-weight: bold; color: #2e7d32; letter-spacing: 5px; margin: 0;">{{ $code }}</p>
                <p style="color: #689f38; margin-top: 10px; font-size: 14px;">Valid for 60 minutes</p>
            </div>
            
            <p style="color: #555; font-size: 16px;">Enter this code on the password change page to update your password securely.</p>
            
            <p style="color: #555; font-size: 16px;">If you didn't request this change, please ignore this email or contact our support team at <a href="mailto:support@paidreader.app" style="color: #2e7d32; text-decoration: none; border-bottom: 1px dotted #2e7d32;">support@paidreader.app</a>.</p>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="https://paidreader.app/login" style="background: #2e7d32; color: white; text-decoration: none; padding: 12px 30px; border-radius: 4px; font-weight: 500; display: inline-block;">Go to Login</a>
            </div>
            
            <p style="color: #555; margin-top: 30px; font-size: 16px;">Happy earning through reading!</p>
            <p style="color: #555; font-size: 16px;">The paidreader.app Team</p>
        </div>
        
        <!-- Footer -->
        <div style="background-color: #f1f8e9; padding: 20px; text-align: center; border-top: 1px solid #eee;">
            <p style="font-size: 14px; color: #777; margin: 0;">© {{ date('Y') }} paidreader.app. All rights reserved.</p>
            <div style="margin-top: 15px;">
                <a href="https://paidreader.app/terms" style="color: #2e7d32; text-decoration: none; font-size: 13px; margin: 0 10px;">Terms</a>
                <a href="https://paidreader.app/privacy" style="color: #2e7d32; text-decoration: none; font-size: 13px; margin: 0 10px;">Privacy</a>
                <a href="https://paidreader.app/help" style="color: #2e7d32; text-decoration: none; font-size: 13px; margin: 0 10px;">Help Center</a>
            </div>
        </div>
    </div>
</body>
</html>