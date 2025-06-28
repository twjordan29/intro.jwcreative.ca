<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lead Form</title>
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
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* Header Section */
        .header {
            background: #ffffff;
            padding: 80px 0 60px;
            text-align: center;
            border-bottom: 1px solid #e5e5e5;
        }

        .page-title {
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

        /* Form Section */
        .form-content {
            padding: 80px 0;
        }

        .form-section {
            background: #ffffff;
            margin: 0 0 60px 0;
            padding: 60px;
            border: 1px solid #e5e5e5;
        }

        .form-section h2 {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 30px;
            color: #1a1a1a;
            letter-spacing: -0.01em;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            font-size: 0.95rem;
            font-weight: 500;
            color: #1a1a1a;
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px 18px;
            border: 1px solid #e5e5e5;
            background: #ffffff;
            font-size: 1rem;
            font-family: inherit;
            color: #1a1a1a;
            transition: all 0.2s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1a1a1a;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        /* Demo sections grid */
        .demos-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }

        .demo-form-card {
            background: #f8f8f8;
            border: 1px solid #e5e5e5;
            padding: 40px;
        }

        .demo-form-card h3 {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 25px;
            color: #1a1a1a;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e5e5;
        }

        .demo-form-card .form-group {
            margin-bottom: 25px;
        }

        .demo-form-card input,
        .demo-form-card textarea {
            background: #ffffff;
        }

        /* Submit Section */
        .submit-section {
            text-align: center;
            padding: 80px 60px;
            background: #ffffff;
            border: 1px solid #e5e5e5;
        }

        .submit-section h2 {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        .submit-section p {
            color: #666;
            margin-bottom: 50px;
            font-size: 1rem;
        }

        .submit-buttons {
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

            .page-title {
                font-size: 2rem;
            }

            .form-section {
                padding: 40px 30px;
            }

            .form-content {
                padding: 60px 0;
            }

            .submit-buttons {
                flex-direction: column;
                align-items: center;
            }

            .demos-form-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .submit-section {
                padding: 60px 30px;
            }

            .demo-form-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <h1 class="page-title">Add New Lead</h1>
            <p class="subtitle">Create a new lead entry with complete details and demo information</p>
        </header>

        <!-- Form Content -->
        <main class="form-content">
            <form id="leadForm">
                <!-- Basic Information -->
                <section class="form-section">
                    <h2>Basic Information</h2>

                    <div class="form-group">
                        <label for="clientName">Client Name</label>
                        <input type="text" id="clientName" name="clientName" required>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" required>
                    </div>

                    <div class="form-group">
                        <label for="originalPrice">Original Price</label>
                        <input type="number" id="originalPrice" name="originalPrice" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="offerPrice">Offer Price</label>
                        <input type="number" id="offerPrice" name="offerPrice" step="0.01" required>
                    </div>
                </section>

                <!-- Demo Information -->
                <section class="form-section">
                    <h2>Demo Information</h2>
                    <p style="color: #666; margin-bottom: 40px; font-size: 1rem;">
                        Configure up to three demo examples for this lead
                    </p>

                    <div class="demos-form-grid">
                        <!-- Demo 1 -->
                        <div class="demo-form-card">
                            <h3>Demo 1</h3>

                            <div class="form-group">
                                <label for="demo1Title">Title</label>
                                <input type="text" id="demo1Title" name="demo1Title">
                            </div>

                            <div class="form-group">
                                <label for="demo1Type">Type</label>
                                <input type="text" id="demo1Type" name="demo1Type">
                            </div>

                            <div class="form-group">
                                <label for="demo1Image">Image</label>
                                <input type="text" id="demo1Image" name="demo1Image">
                            </div>

                            <div class="form-group">
                                <label for="demo1Url">URL</label>
                                <input type="url" id="demo1Url" name="demo1Url">
                            </div>
                        </div>

                        <!-- Demo 2 -->
                        <div class="demo-form-card">
                            <h3>Demo 2</h3>

                            <div class="form-group">
                                <label for="demo2Title">Title</label>
                                <input type="text" id="demo2Title" name="demo2Title">
                            </div>

                            <div class="form-group">
                                <label for="demo2Type">Type</label>
                                <input type="text" id="demo2Type" name="demo2Type">
                            </div>

                            <div class="form-group">
                                <label for="demo2Image">Image</label>
                                <input type="text" id="demo2Image" name="demo2Image">
                            </div>

                            <div class="form-group">
                                <label for="demo2Url">URL</label>
                                <input type="url" id="demo2Url" name="demo2Url">
                            </div>
                        </div>

                        <!-- Demo 3 -->
                        <div class="demo-form-card">
                            <h3>Demo 3</h3>

                            <div class="form-group">
                                <label for="demo3Title">Title</label>
                                <input type="text" id="demo3Title" name="demo3Title">
                            </div>

                            <div class="form-group">
                                <label for="demo3Type">Type</label>
                                <input type="text" id="demo3Type" name="demo3Type">
                            </div>

                            <div class="form-group">
                                <label for="demo3Image">Image</label>
                                <input type="text" id="demo3Image" name="demo3Image">
                            </div>

                            <div class="form-group">
                                <label for="demo3Url">URL</label>
                                <input type="url" id="demo3Url" name="demo3Url">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Submit Section -->
                <section class="submit-section">
                    <h2>Ready to Create Lead?</h2>
                    <p>Review all information above and submit to create your new lead entry</p>

                    <div class="submit-buttons">
                        <button type="submit" class="btn btn-primary">Create Lead</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset Form</button>
                    </div>
                </section>
            </form>
        </main>
    </div>

    <script>
        // Form handling
        document.getElementById('leadForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(this);

            try {
                // Submit to your PHP API
                const response = await fetch('api/add-lead.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    const result = await response.text();
                    alert('Success: ' + result);

                    // Optionally reset form after successful submission
                    if (confirm('Lead created successfully! Would you like to create another lead?')) {
                        this.reset();
                    }
                } else {
                    const error = await response.text();
                    alert('Error: ' + error);
                }
            } catch (error) {
                console.error('Network error:', error);
                alert('Network error: Could not connect to server');
            }
        });

        function resetForm() {
            if (confirm('Are you sure you want to reset the form? All data will be lost.')) {
                document.getElementById('leadForm').reset();
            }
        }


        function generateSlug(text) {
            return text
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .substring(0, 50)
                .replace(/^-|-$/g, '');
        }
    </script>
</body>

</html>