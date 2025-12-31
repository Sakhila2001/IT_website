<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Confirmation</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eeeeee;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 0 20px;
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 25px;
        }
        p {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3498db;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 25px 0;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 14px;
            color: #7f8c8d;
            text-align: center;
        }
        .highlight {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
@php
    use App\Models\ContactDetailModel;
    $companyName = ContactDetailModel::first()->company_name;
    $companyLogo = ContactDetailModel::first()->company_logo;
    $companyAddress = ContactDetailModel::first()->address_info;
    $companyEmail = ContactDetailModel::first()->email;
@endphp
    <div class="header">
        <!-- Replace with your actual logo -->
        <img src="{{ asset('storage/' . $companyLogo) }}" alt="Company Logo" style="max-height: 50px;">
        </div>
   

    <div class="content">
        <h1>Welcome to Our Community!</h1>
        
        <p>Hello,</p>
        
        <p>Thank you for subscribing to our newsletter with the email address: <strong>{{ $subscription->email }}</strong>.</p>
        
        <div class="highlight">
            <p>You'll now receive our latest updates, exclusive offers, and valuable content directly to your inbox.</p>
        </div>
        
        <p>We're excited to have you on board!</p>
        

        <p>Best regards,<br>
        The Team at {{ $companyName?? ' ' }}</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ $companyName?? ' ' }}. All rights reserved.</p>
        <p>
        {{ $companyAddress?? ' ' }}<br>
            <a href="mailto:{{ $companyEmail?? ' ' }}">{{ $companyEmail?? ' ' }}</a>
        </p>
    </div>
</body>
</html>