<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triumph School API Documentation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .intro-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }

        .intro-section h2 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .endpoint-card {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 30px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .endpoint-card:hover {
            border-color: #667eea;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
        }

        .endpoint-header {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .endpoint-header h3 {
            font-size: 1.3em;
            margin: 0;
        }

        .method-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.9em;
        }

        .method-get {
            background: #28a745;
        }

        .method-post {
            background: #007bff;
        }

        .method-put {
            background: #ffc107;
            color: black;
        }

        .method-delete {
            background: #dc3545;
        }

        .endpoint-body {
            padding: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.1em;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 5px;
        }

        .parameter-table, .response-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .parameter-table th, .response-table th {
            background: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }

        .parameter-table td, .response-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .parameter-table tr:hover, .response-table tr:hover {
            background: #f8f9fa;
        }

        .code-block {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }

        .success-block {
            background: #d4edda;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .success-block .label {
            color: #155724;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .error-block {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .error-block .label {
            color: #721c24;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .auth-required {
            display: inline-block;
            background: #dc3545;
            color: white;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 0.85em;
            margin-left: 10px;
        }

        .description {
            color: #666;
            margin: 10px 0;
            font-style: italic;
        }

        .required {
            color: #dc3545;
            font-weight: bold;
        }

        .optional {
            color: #28a745;
            font-weight: bold;
        }

        footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            border-top: 1px solid #e9ecef;
        }

        .toc {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
        }

        .toc h3 {
            color: #667eea;
            margin-bottom: 15px;
        }

        .toc ul {
            list-style: none;
        }

        .toc li {
            margin: 8px 0;
        }

        .toc a {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s;
        }

        .toc a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .response-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.9em;
            margin-right: 10px;
        }

        .status-200 {
            background: #d4edda;
            color: #155724;
        }

        .status-201 {
            background: #d4edda;
            color: #155724;
        }

        .status-400 {
            background: #fff3cd;
            color: #856404;
        }

        .status-422 {
            background: #fff3cd;
            color: #856404;
        }

        .status-500 {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Triumph School API</h1>
            <p>Complete API Documentation</p>
        </div>

        <div class="content">
            <!-- Introduction Section -->
            <div class="intro-section">
                <h2>📋 Getting Started</h2>
                <p><strong>Base URL:</strong> <code>{{ url('/api') }}</code></p>
                <p><strong>Authentication:</strong> All endpoints require Bearer token authentication via Sanctum. Include the token in the Authorization header:</p>
                <div class="code-block">Authorization: Bearer YOUR_TOKEN_HERE</div>
                <p><strong>Response Format:</strong> All responses are in JSON format.</p>
            </div>

            <!-- Table of Contents -->
            <div class="toc">
                <h3>📑 Table of Contents</h3>
                <ul>
                    <li><a href="#auth">Authentication</a></li>
                    <li><a href="#students">Students Endpoints</a></li>
                    <li><a href="#intakes">Intakes Endpoints</a></li>
                    <li><a href="#courses">Courses Endpoints</a></li>
                    <li><a href="#fee-payments">Fee Payments Endpoints</a></li>
                </ul>
            </div>

            <!-- AUTHENTICATION -->
            <h2 style="color: #667eea; margin-top: 40px; margin-bottom: 20px;" id="auth">🔐 Authentication</h2>

            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Sign Up (Register)</h3>
                    <div>
                        <span class="method-badge method-post">POST</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Create a new user account and receive credentials (typically returns the created user). For API usage you may want to follow signup with login to obtain a token.</div>

                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">POST /api/signup</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Request Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>name</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>User's full name</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td>email</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Unique email address</td>
                                </tr>
                                <tr>
                                    <td>password</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Password for the account</td>
                                </tr>
                                <tr>
                                    <td>password_confirmation</td>
                                    <td>string</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Confirm password (if the API validates confirmation)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X POST "{{ url('/api/signup') }}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "New User",
    "email": "new.user@example.com",
    "password": "secret123",
    "password_confirmation": "secret123"
  }'</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (201 Created)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-201">201</span>Created</div>
                            <div class="code-block">{
  "user": {
    "id": 10,
    "name": "New User",
    "email": "new.user@example.com",
    "created_at": "2025-12-10T12:00:00.000000Z"
  }
}</div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Validation Error (422)</div>
                        <div class="error-block">
                            <div class="label"><span class="response-status status-422">422</span>Validation Failed</div>
                            <div class="code-block">{
  "message": "The email has already been taken.",
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  }
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Login (Obtain Token)</h3>
                    <div>
                        <span class="method-badge method-post">POST</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Authenticate a user and return an access token (Bearer) for use with protected endpoints.</div>

                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">POST /api/login</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Request Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>email</td>
                                    <td>email</td>
                                    <td><span class="required">Required</span></td>
                                    <td>User email</td>
                                </tr>
                                <tr>
                                    <td>password</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>User password</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X POST "{{ url('/api/login') }}" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "new.user@example.com",
    "password": "secret123"
  }'</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Authenticated</div>
                            <div class="code-block">{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGci...",
  "token_type": "Bearer",
  "user": {
    "id": 10,
    "name": "New User",
    "email": "new.user@example.com"
  }
}</div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Unauthorized (401)</div>
                        <div class="error-block">
                            <div class="label"><span class="response-status status-500">401</span>Unauthorized</div>
                            <div class="code-block">{
  "message": "Invalid credentials"
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STUDENTS ENDPOINTS -->
            <h2 style="color: #667eea; margin-top: 40px; margin-bottom: 20px;" id="students">👥 Students Endpoints</h2>

            <!-- GET Students -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Get All Students</h3>
                    <div>
                        <span class="method-badge method-get">GET</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Retrieve a list of all students with their associated user and intake information.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">GET /api/students</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Parameters</div>
                        <p>No parameters required.</p>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X GET "{{ url('/api/students') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Success</div>
                            <div class="code-block">[
  {
    "id": 1,
    "user_id": 5,
    "intake_id": 2,
    "mode_of_contact": "email",
    "status": "active",
    "name": "John Doe",
    "image": "images/john.jpg",
    "intake_name": "2025-Q1",
    "created_at": "2025-12-10T10:30:00.000000Z",
    "updated_at": "2025-12-10T10:30:00.000000Z"
  }
]</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- POST Create Student -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Create a New Student</h3>
                    <div>
                        <span class="method-badge method-post">POST</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Create a new student with their user account and assign them to an intake.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">POST /api/students</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Request Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>name</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Student's full name</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td>email</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Student's email address (must be unique)</td>
                                </tr>
                                <tr>
                                    <td>intake_id</td>
                                    <td>integer</td>
                                    <td><span class="required">Required</span></td>
                                    <td>ID of the intake to assign the student to</td>
                                </tr>
                                <tr>
                                    <td>phone</td>
                                    <td>string</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Student's phone number</td>
                                </tr>
                                <tr>
                                    <td>course</td>
                                    <td>string</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Course name or ID</td>
                                </tr>
                                <tr>
                                    <td>mode_of_contact</td>
                                    <td>string</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Preferred contact method (e.g., email, phone, sms)</td>
                                </tr>
                                <tr>
                                    <td>image</td>
                                    <td>file</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Student's profile image (image file)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X POST "{{ url('/api/students') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Jane Smith",
    "email": "jane.smith@example.com",
    "intake_id": 2,
    "phone": "+1234567890",
    "course": "Web Development",
    "mode_of_contact": "email"
  }'</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Student Created</div>
                            <div class="code-block">{
  "message": "Student created successfully"
}</div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Validation Error (422)</div>
                        <div class="error-block">
                            <div class="label"><span class="response-status status-422">422</span>Validation Failed</div>
                            <div class="code-block">{
  "message": "The email has already been taken.",
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  }
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GET Single Student -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Get Student Details</h3>
                    <div>
                        <span class="method-badge method-get">GET</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Retrieve detailed information about a specific student.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">GET /api/students/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Path Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>id</td>
                                    <td>integer</td>
                                    <td>The student ID</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X GET "{{ url('/api/students/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Success</div>
                            <div class="code-block">{
  "id": 1,
  "user_id": 5,
  "intake_id": 2,
  "mode_of_contact": "email",
  "status": "active",
  "created_at": "2025-12-10T10:30:00.000000Z",
  "updated_at": "2025-12-10T10:30:00.000000Z"
}</div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Not Found (404)</div>
                        <div class="error-block">
                            <div class="label"><span class="response-status status-404">404</span>Not Found</div>
                            <div class="code-block">{
  "message": "No query results found for model [App\\Models\\Student] 1"
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PUT Update Student -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Update Student</h3>
                    <div>
                        <span class="method-badge method-put">PUT</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Update student information. All fields are optional.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">PUT /api/students/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Request Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>course</td>
                                    <td>string</td>
                                    <td>Updated course name/ID</td>
                                </tr>
                                <tr>
                                    <td>mode_of_contact</td>
                                    <td>string</td>
                                    <td>Updated contact method</td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td>string</td>
                                    <td>Updated status (e.g., active, inactive, graduated)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X PUT "{{ url('/api/students/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "course": "Advanced Web Development",
    "status": "active"
  }'</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Updated</div>
                            <div class="code-block">{
  "message": "Student updated successfully"
}</div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Error (500)</div>
                        <div class="error-block">
                            <div class="label"><span class="response-status status-500">500</span>Server Error</div>
                            <div class="code-block">{
  "message": "Student with ID 999 not found"
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETE Student -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Delete Student</h3>
                    <div>
                        <span class="method-badge method-delete">DELETE</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Delete a student record from the system.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">DELETE /api/students/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Path Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>id</td>
                                    <td>integer</td>
                                    <td>The student ID to delete</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X DELETE "{{ url('/api/students/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Deleted</div>
                            <div class="code-block">{
  "message": "Student deleted successfully"
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INTAKES ENDPOINTS -->
            <h2 style="color: #667eea; margin-top: 40px; margin-bottom: 20px;" id="intakes">📅 Intakes Endpoints</h2>

            <!-- GET Intakes -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Get All Intakes</h3>
                    <div>
                        <span class="method-badge method-get">GET</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Retrieve a list of all intakes (enrollment periods).</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">GET /api/intakes</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Parameters</div>
                        <p>No parameters required.</p>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X GET "{{ url('/api/intakes') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Success</div>
                            <div class="code-block">{
  "intakes": [
    {
      "id": 1,
      "name": "2025-Q1",
      "start_month": "January",
      "end_month": "March",
      "year": 2025,
      "student_capacity": 50,
      "progress": 45,
      "status": "active",
      "created_at": "2025-12-10T10:30:00.000000Z",
      "updated_at": "2025-12-10T10:30:00.000000Z"
    }
  ]
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- POST Create Intake -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Create a New Intake</h3>
                    <div>
                        <span class="method-badge method-post">POST</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Create a new intake (enrollment period).</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">POST /api/intakes</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Request Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>name</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Intake name (e.g., 2025-Q1)</td>
                                </tr>
                                <tr>
                                    <td>start_month</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Starting month of the intake</td>
                                </tr>
                                <tr>
                                    <td>end_month</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Ending month of the intake</td>
                                </tr>
                                <tr>
                                    <td>year</td>
                                    <td>integer</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Year of the intake</td>
                                </tr>
                                <tr>
                                    <td>student_capacity</td>
                                    <td>integer</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Maximum number of students allowed</td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td>string</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Intake status (e.g., active, inactive, completed)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X POST "{{ url('/api/intakes') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "2025-Q2",
    "start_month": "April",
    "end_month": "June",
    "year": 2025,
    "student_capacity": 60,
    "status": "active"
  }'</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Created</div>
                            <div class="code-block">{
  "message": "Intake created successfully"
}</div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Validation Error (422)</div>
                        <div class="error-block">
                            <div class="label"><span class="response-status status-422">422</span>Validation Failed</div>
                            <div class="code-block">{
  "message": "The name field is required."
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GET Single Intake -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Get Intake Details</h3>
                    <div>
                        <span class="method-badge method-get">GET</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Retrieve detailed information about a specific intake.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">GET /api/intakes/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Path Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>id</td>
                                    <td>integer</td>
                                    <td>The intake ID</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X GET "{{ url('/api/intakes/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Success</div>
                            <div class="code-block">{
  "intake": {
    "id": 1,
    "name": "2025-Q1",
    "start_month": "January",
    "end_month": "March",
    "year": 2025,
    "student_capacity": 50,
    "progress": 45,
    "status": "active",
    "created_at": "2025-12-10T10:30:00.000000Z",
    "updated_at": "2025-12-10T10:30:00.000000Z"
  }
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PUT Update Intake -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Update Intake</h3>
                    <div>
                        <span class="method-badge method-put">PUT</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Update intake information. All fields are optional.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">PUT /api/intakes/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Request Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>name</td>
                                    <td>string</td>
                                    <td>Updated intake name</td>
                                </tr>
                                <tr>
                                    <td>start_month</td>
                                    <td>string</td>
                                    <td>Updated start month</td>
                                </tr>
                                <tr>
                                    <td>end_month</td>
                                    <td>string</td>
                                    <td>Updated end month</td>
                                </tr>
                                <tr>
                                    <td>year</td>
                                    <td>integer</td>
                                    <td>Updated year</td>
                                </tr>
                                <tr>
                                    <td>student_capacity</td>
                                    <td>integer</td>
                                    <td>Updated student capacity</td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td>string</td>
                                    <td>Updated status</td>
                                </tr>
                                <tr>
                                    <td>progress</td>
                                    <td>integer</td>
                                    <td>Updated progress value</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X PUT "{{ url('/api/intakes/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "status": "completed",
    "progress": 100
  }'</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Updated</div>
                            <div class="code-block">{
  "message": "Intake updated successfully"
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETE Intake -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Delete Intake</h3>
                    <div>
                        <span class="method-badge method-delete">DELETE</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Delete an intake record from the system.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">DELETE /api/intakes/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X DELETE "{{ url('/api/intakes/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Deleted</div>
                            <div class="code-block">{
  "message": "Intake deleted successfully"
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COURSES ENDPOINTS -->
            <h2 style="color: #667eea; margin-top: 40px; margin-bottom: 20px;" id="courses">📚 Courses Endpoints</h2>

            <!-- GET Courses -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Get All Courses</h3>
                    <div>
                        <span class="method-badge method-get">GET</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Retrieve a list of all available courses.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">GET /api/courses</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Parameters</div>
                        <p>No parameters required.</p>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X GET "{{ url('/api/courses') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Success</div>
                            <div class="code-block">[
  {
    "id": 1,
    "title": "Web Development Basics",
    "slug": "web_development_basics",
    "description": "Learn the fundamentals of web development",
    "price": "9999",
    "cover": "courses/web-dev.jpg",
    "status": "active",
    "created_at": "2025-12-10T10:30:00.000000Z",
    "updated_at": "2025-12-10T10:30:00.000000Z"
  }
]</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- POST Create Course -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Create a New Course</h3>
                    <div>
                        <span class="method-badge method-post">POST</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Create a new course offering.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">POST /api/courses</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Request Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>title</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Course title</td>
                                </tr>
                                <tr>
                                    <td>description</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Course description</td>
                                </tr>
                                <tr>
                                    <td>price</td>
                                    <td>string</td>
                                    <td><span class="required">Required</span></td>
                                    <td>Course price</td>
                                </tr>
                                <tr>
                                    <td>cover</td>
                                    <td>file</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Course cover image (image file)</td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td>string</td>
                                    <td><span class="optional">Optional</span></td>
                                    <td>Course status (e.g., active, inactive)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X POST "{{ url('/api/courses') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Advanced PHP Development",
    "description": "Master advanced PHP concepts and frameworks",
    "price": "15000",
    "status": "active"
  }'</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (201 Created)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-201">201</span>Created</div>
                            <div class="code-block">{
  "id": 2,
  "title": "Advanced PHP Development",
  "slug": "advanced_php_development",
  "description": "Master advanced PHP concepts and frameworks",
  "price": "15000",
  "cover": null,
  "status": "active",
  "created_at": "2025-12-10T11:45:00.000000Z",
  "updated_at": "2025-12-10T11:45:00.000000Z"
}</div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Validation Error (400)</div>
                        <div class="error-block">
                            <div class="label"><span class="response-status status-400">400</span>Validation Failed</div>
                            <div class="code-block">{
  "title": [
    "The title field is required."
  ]
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GET Single Course -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Get Course Details</h3>
                    <div>
                        <span class="method-badge method-get">GET</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Retrieve detailed information about a specific course.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">GET /api/courses/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Path Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>id</td>
                                    <td>integer</td>
                                    <td>The course ID</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X GET "{{ url('/api/courses/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Success</div>
                            <div class="code-block">{
  "course": {
    "id": 1,
    "title": "Web Development Basics",
    "slug": "web_development_basics",
    "description": "Learn the fundamentals of web development",
    "price": "9999",
    "cover": "courses/web-dev.jpg",
    "status": "active",
    "created_at": "2025-12-10T10:30:00.000000Z",
    "updated_at": "2025-12-10T10:30:00.000000Z"
  }
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PUT Update Course -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Update Course</h3>
                    <div>
                        <span class="method-badge method-put">PUT</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Update course information. All fields are optional.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">PUT /api/courses/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Request Parameters</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>title</td>
                                    <td>string</td>
                                    <td>Updated course title</td>
                                </tr>
                                <tr>
                                    <td>description</td>
                                    <td>string</td>
                                    <td>Updated course description</td>
                                </tr>
                                <tr>
                                    <td>price</td>
                                    <td>string</td>
                                    <td>Updated course price</td>
                                </tr>
                                <tr>
                                    <td>cover</td>
                                    <td>file</td>
                                    <td>Updated course cover image</td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td>string</td>
                                    <td>Updated course status</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X PUT "{{ url('/api/courses/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "price": "12000",
    "status": "inactive"
  }'</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Updated</div>
                            <div class="code-block">{
  "message": "Course updated successfully"
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETE Course -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Delete Course</h3>
                    <div>
                        <span class="method-badge method-delete">DELETE</span>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="description">Delete a course record from the system.</div>
                    
                    <div class="section">
                        <div class="section-title">Endpoint</div>
                        <div class="code-block">DELETE /api/courses/{id}</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Request</div>
                        <div class="code-block">curl -X DELETE "{{ url('/api/courses/1') }}" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Accept: application/json"</div>
                    </div>

                    <div class="section">
                        <div class="section-title">Sample Response - Success (200 OK)</div>
                        <div class="success-block">
                            <div class="label"><span class="response-status status-200">200</span>Deleted</div>
                            <div class="code-block">{
  "message": "Course deleted successfully"
}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FEE PAYMENTS ENDPOINTS -->
            <h2 style="color: #667eea; margin-top: 40px; margin-bottom: 20px;" id="fee-payments">💳 Fee Payments Endpoints</h2>

            <div class="intro-section">
                <h3>ℹ️ Status</h3>
                <p>The Fee Payments API endpoints are currently <strong>under development</strong>. The controller is stubbed and ready for implementation. The following endpoints will be available once implemented:</p>
            </div>

            <!-- Fee Payments Endpoints Structure -->
            <div class="endpoint-card">
                <div class="endpoint-header">
                    <h3>Fee Payments Endpoints (Coming Soon)</h3>
                    <div>
                        <span class="auth-required">Auth Required</span>
                    </div>
                </div>
                <div class="endpoint-body">
                    <div class="section">
                        <div class="section-title">Available Endpoints</div>
                        <table class="parameter-table">
                            <thead>
                                <tr>
                                    <th>Method</th>
                                    <th>Endpoint</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="method-badge method-get">GET</span></td>
                                    <td><code>/api/fee-payments</code></td>
                                    <td>Get all fee payments</td>
                                </tr>
                                <tr>
                                    <td><span class="method-badge method-post">POST</span></td>
                                    <td><code>/api/fee-payments</code></td>
                                    <td>Create a new fee payment</td>
                                </tr>
                                <tr>
                                    <td><span class="method-badge method-get">GET</span></td>
                                    <td><code>/api/fee-payments/{id}</code></td>
                                    <td>Get fee payment details</td>
                                </tr>
                                <tr>
                                    <td><span class="method-badge method-put">PUT</span></td>
                                    <td><code>/api/fee-payments/{id}</code></td>
                                    <td>Update fee payment</td>
                                </tr>
                                <tr>
                                    <td><span class="method-badge method-delete">DELETE</span></td>
                                    <td><code>/api/fee-payments/{id}</code></td>
                                    <td>Delete fee payment</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <div class="section-title">Expected Parameters (To Be Implemented)</div>
                        <p>Expected parameters will include:</p>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li><strong>student_id</strong> (required) - Student making the payment</li>
                            <li><strong>amount</strong> (required) - Payment amount</li>
                            <li><strong>payment_date</strong> (optional) - Date of payment</li>
                            <li><strong>payment_method</strong> (optional) - Method of payment</li>
                            <li><strong>status</strong> (optional) - Payment status (e.g., pending, completed, failed)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Common Error Responses -->
            <h2 style="color: #667eea; margin-top: 40px; margin-bottom: 20px;">⚠️ Common Error Responses</h2>

            <div class="intro-section">
                <h3>Unauthorized (401)</h3>
                <p>Returned when authentication token is missing or invalid.</p>
                <div class="error-block">
                    <div class="label"><span class="response-status status-500">401</span>Unauthorized</div>
                    <div class="code-block">{
  "message": "Unauthenticated."
}</div>
                </div>
            </div>

            <div class="intro-section">
                <h3>Not Found (404)</h3>
                <p>Returned when a resource with the specified ID does not exist.</p>
                <div class="error-block">
                    <div class="label"><span class="response-status status-500">404</span>Not Found</div>
                    <div class="code-block">{
  "message": "No query results found for model [App\\Models\\Student] 999"
}</div>
                </div>
            </div>

            <div class="intro-section">
                <h3>Server Error (500)</h3>
                <p>Returned when an unexpected server error occurs.</p>
                <div class="error-block">
                    <div class="label"><span class="response-status status-500">500</span>Server Error</div>
                    <div class="code-block">{
  "message": "Something went wrong. Exception message details..."
}</div>
                </div>
            </div>

        </div>

        <footer>
            <p>&copy; 2025 Triumph School API Documentation. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
