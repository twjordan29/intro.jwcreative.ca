<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - 404</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            background: #fafafa;
            font-weight: 400;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Header Section */
        .header {
            background: #ffffff;
            padding: 80px 0 60px;
            text-align: center;
            border-bottom: 1px solid #e5e5e5;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 300;
            color: #1a1a1a;
            margin-bottom: 20px;
            letter-spacing: -0.02em;
            line-height: 1;
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 300;
            color: #1a1a1a;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        .subtitle {
            font-size: 1rem;
            color: #666;
            font-weight: 400;
            letter-spacing: 0.01em;
        }

        /* Main Content */
        .main-content {
            padding: 80px 0;
        }

        .section {
            background: #ffffff;
            margin: 0 0 60px 0;
            padding: 60px;
            border: 1px solid #e5e5e5;
        }

        .section h2 {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 30px;
            color: #1a1a1a;
            letter-spacing: -0.01em;
        }

        .section p {
            font-size: 1rem;
            color: #4a4a4a;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .section ul {
            list-style: none;
            margin: 30px 0;
        }

        .section li {
            font-size: 1rem;
            color: #4a4a4a;
            margin-bottom: 12px;
            padding-left: 20px;
            position: relative;
            line-height: 1.7;
        }

        .section li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: #1a1a1a;
            font-weight: 500;
        }

        /* CTA Buttons */
        .cta-section {
            text-align: center;
            padding: 80px 60px;
            background: #ffffff;
            border: 1px solid #e5e5e5;
        }

        .cta-section h2 {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        .cta-section p {
            color: #666;
            margin-bottom: 50px;
            font-size: 1rem;
        }

        .cta-buttons {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 18px 40px;
            border: 1px solid #1a1a1a;
            background: transparent;
            font-size: 0.95rem;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            min-width: 180px;
            font-family: inherit;
        }

        .btn-primary {
            background: #1a1a1a;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #333333;
            border-color: #333333;
        }

        .btn-secondary {
            background: #ffffff;
            color: #1a1a1a;
            border: 1px solid #1a1a1a;
        }

        .btn-secondary:hover {
            background: #f5f5f5;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }

            .header {
                padding: 60px 0 40px;
            }

            .error-code {
                font-size: 6rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .section {
                padding: 40px 30px;
            }

            .main-content {
                padding: 60px 0;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .cta-section {
                padding: 60px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="error-code">404</div>
            <h1 class="error-title">Page Not Found</h1>
            <p class="subtitle">The page you're looking for doesn't exist</p>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="section">
                <h2>Why Did This Happen?</h2>
                <p>You may have landed on this page for a few possible reasons:</p>
                <ul>
                    <li>
                        <strong>You clicked “I Need More Time”</strong> – When we sent you your custom proposal, there
                        were two buttons at the bottom of the page. If you selected “I Need More Time,” your proposal
                        was automatically archived. But don’t worry — your exclusive offer is still valid for up to one
                        year.
                    </li>
                    <li>
                        <strong>We haven’t sent your proposal yet</strong> – We’re working hard to help local businesses
                        build their online presence. It’s possible we haven’t gotten to your proposal yet, or it may
                        have been missed.
                    </li>
                </ul>
            </div>

            <div class="section">
                <h2>What Can You Do?</h2>
                <p>No stress — here’s how you can move forward:</p>
                <ul>
                    <li>
                        <strong>Changed your mind?</strong> – That’s great! We’re always excited to support local
                        businesses. Just email us at <a href="mailto:hello@jwcreative.ca">hello@jwcreative.ca</a> and
                        let us know you'd like to proceed, along with your business name.
                    </li>
                    <li>
                        <strong>Still need more time?</strong> – Totally understandable. If you're still thinking it
                        over, send us a quick message and we’ll extend your proposal timeline.
                    </li>
                    <li>
                        <strong>Want to reach out directly?</strong> – Don’t be shy! If we haven’t reached out yet, feel
                        free to email us at <a href="mailto:hello@jwcreative.ca">hello@jwcreative.ca</a> or message us
                        on our <a href="https://facebook.com/jwcreativeca">Facebook page</a>.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>