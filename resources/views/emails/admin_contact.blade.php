<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message Notification</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #4a4a4a;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        
        /* Email Container */
        .email-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 5%;
            margin: 5% auto;
            max-width: 700px;
            width: 90%;
        }
        
        /* Header Section */
        .header {
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 20px;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .logo {
            color: #3498db;
            font-weight: bold;
            font-size: clamp(18px, 2.5vw, 24px);
            margin-bottom: 5px;
        }
        
        h1 {
            color: #2c3e50;
            font-size: clamp(20px, 3vw, 24px);
            margin: 0 0 10px;
        }
        
        .subheader {
            color: #7f8c8d;
            font-size: clamp(14px, 2vw, 16px);
            margin: 0;
        }
        
        /* Content Sections */
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            color: #3498db;
            font-size: clamp(16px, 2.5vw, 18px);
            margin: 0 0 15px;
            font-weight: 600;
        }
        
        .info-item {
            margin-bottom: 12px;
            display: flex;
            flex-wrap: wrap;
        }
        
        .label {
            font-weight: 600;
            color: #2c3e50;
            min-width: 120px;
            width: 30%;
            margin-bottom: 5px;
        }
        
        .value {
            flex: 1;
            min-width: 200px;
            width: 70%;
            word-break: break-word;
        }
        
        .message-content {
            background: #f8f9fa;
            border-left: 3px solid #3498db;
            padding: 15px;
            margin: 15px 0;
            font-style: italic;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
            color: #7f8c8d;
            font-size: clamp(12px, 1.8vw, 14px);
            text-align: center;
        }
        
        /* Responsive Adjustments */
        @media only screen and (max-width: 600px) {
            .email-container {
                padding: 8%;
                width: 84%;
                margin: 8% auto;
            }
            
            .info-item {
                flex-direction: column;
            }
            
            .label, .value {
                width: 100%;
            }
            
            .label {
                margin-bottom: 2px;
            }
        }
        
        @media only screen and (max-width: 480px) {
            .email-container {
                border-radius: 0;
                width: 100%;
                margin: 0;
                padding: 15px;
            }
            
            .header {
                padding-bottom: 15px;
                margin-bottom: 20px;
            }
            
            .message-content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
        @php
    use App\Models\ContactDetailModel;
    $companyName = ContactDetailModel::first()->company_name;
    $companyLogo = ContactDetailModel::first()->company_logo;
@endphp

            <div class="logo">  <img src="{{ asset('storage/' . $companyLogo) }}" alt="Company Logo" style="max-height: 50px;"></div>
            
            <h1>New Contact Message Received</h1>
            <p class="subheader">A visitor has submitted a contact form on your website</p>
        </div>

        <div class="section">
            <h2 class="section-title">Sender Information</h2>
            <div class="info-item">
                <span class="label">Name:</span>
                <span class="value">{{ $data['name'] }}</span>
            </div>
            <div class="info-item">
                <span class="label">Email:</span>
                <span class="value"><a href="mailto:{{ $data['email'] }}" style="color: #3498db; text-decoration: none;">{{ $data['email'] }}</a></span>
            </div>
            <div class="info-item">
                <span class="label">Subject:</span>
                <span class="value">{{ $data['subject'] }}</span>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Message</h2>
            <div class="message-content">
                {{ $data['message'] }}
            </div>
        </div>
      

        <div class="footer">
            <p>This message was automatically generated by your website contact form.</p>
            <p>© {{ date('Y') }} {{ $companyName?? ''}}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>