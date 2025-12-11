<!-- FILE: admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Resume Editor</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-header {
            background: linear-gradient(135deg, #bc5e38 0%, #bc5e38 100%);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .editor-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .section-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .section-card:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        .btn-save {
            background: #28a745;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
        }
        .btn-save:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
        }
        .preview-btn {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            margin-right: 10px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .save-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: none;
        }
        .user-badge {
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <div class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class=""></i> Resume Editor</h1>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="user-badge">
                        <i class="fas fa-user"></i> Admin
                    </span>
                    <button class="btn btn-logout" onclick="Auth.logout()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Alert -->
    <div id="saveAlert" class="save-alert alert alert-success alert-dismissible fade show" role="alert">
        Changes saved successfully!
        <button type="button" class="btn-close" onclick="hideAlert()"></button>
    </div>

    <!-- Main Editor -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Edit Resume Sections</h3>
                    <div>
                        <a href="index.php" target="_blank" class="btn preview-btn">
                            <i class="fas fa-eye"></i> Preview Resume
                        </a>
                        <button class="btn btn-save" onclick="saveAllChanges()">
                            <i class="fas fa-save"></i> Save All Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-user"></i> About Section</h4>
                <button class="btn btn-sm btn-outline-primary" onclick="saveSection('about')">
                    <i class="fas fa-save"></i> Save Section
                </button>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="Khryssha">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="Andres">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" id="address" value="195 San Lorenzo Street · G.M.A., AVITE">
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" value="09657098585">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="khrysshaandres@gmail.com">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Professional Summary</label>
                <textarea class="form-control" id="summary" rows="4">I am experienced in leveraging agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</textarea>
            </div>
        </div>

        <!-- Experience Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-briefcase"></i> Experience</h4>
                <div>
                    <button class="btn btn-sm btn-outline-success" onclick="addExperience()">
                        <i class="fas fa-plus"></i> Add Experience
                    </button>
                </div>
            </div>
            
            <div id="experienceItems">
                <!-- Experience items will be added here dynamically -->
            </div>
        </div>

        <!-- Education Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-graduation-cap"></i> Education</h4>
                <div>
                    <button class="btn btn-sm btn-outline-success" onclick="addEducation()">
                        <i class="fas fa-plus"></i> Add Education
                    </button>
                </div>
            </div>
            
            <div id="educationItems">
                <!-- Education items will be added here dynamically -->
            </div>
        </div>

        <!-- Skills Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-code"></i> Skills</h4>
                <button class="btn btn-sm btn-outline-primary" onclick="saveSkills()">
                    <i class="fas fa-save"></i> Save Skills
                </button>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Skill List (comma separated)</label>
                <input type="text" class="form-control" id="skillsList" value="HTML, CSS, JavaScript, Angular, React, Node.js, Sass, WordPress">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Workflow Description</label>
                <textarea class="form-control" id="workflow" rows="3">Mobile-First, Responsive Design, Cross Browser Testing & Debugging, Cross Functional Teams, Agile Development & Scrum</textarea>
            </div>
        </div>

        <!-- Save All Button -->
        <div class="text-center mb-5">
            <button class="btn btn-lg btn-save" onclick="saveAllChanges()">
                <i class="fas fa-save"></i> Save All Changes to Resume
            </button>
            <p class="text-muted mt-2">Changes will be reflected immediately on your resume page</p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/auth.js"></script>
    <script src="js/editor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>