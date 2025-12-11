<?php
session_start();

// Only check PHP session, NOT localStorage
if (!isset($_SESSION['resume_logged_in']) || $_SESSION['resume_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['resume_username'] ?? 'Admin';

// Now set localStorage for JavaScript to use
echo '<script>
    if (!localStorage.getItem("resumeLoggedIn")) {
        localStorage.setItem("resumeLoggedIn", "true");
        localStorage.setItem("resumeUsername", "' . $username . '");
    }
</script>';
?>
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
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Muli', sans-serif;
        }
        .admin-header {
            background: linear-gradient(135deg, #bd5d38 0%, #a0522d 100%);
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
            border-left: 4px solid #bd5d38;
        }
        .section-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .section-card:hover {
            border-color: #bd5d38;
            box-shadow: 0 5px 15px rgba(189, 93, 56, 0.1);
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
        .btn-primary-custom {
            background: #bd5d38;
            color: white;
            border: none;
        }
        .btn-primary-custom:hover {
            background: #a0522d;
            color: white;
        }
        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
        }
        .save-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: none;
            min-width: 300px;
        }
        .user-badge {
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .form-control:focus {
            border-color: #bd5d38;
            box-shadow: 0 0 0 0.2rem rgba(189, 93, 56, 0.25);
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <div class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 style="font-family: 'Saira Extra Condensed', sans-serif;">
                        <i class="fas fa-edit"></i> Resume Editor
                    </h1>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="user-badge">
                        <i class="fas fa-user"></i> <?php echo htmlspecialchars($username); ?>
                    </span>
                    <a href="logout.php" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Alert -->
    <div id="saveAlert" class="save-alert alert alert-success alert-dismissible fade show" role="alert">
        <span id="alertMessage">Changes saved successfully!</span>
        <button type="button" class="btn-close" onclick="hideAlert()"></button>
    </div>

    <!-- Main Editor -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 style="font-family: 'Saira Extra Condensed', sans-serif;">Edit Resume Sections</h3>
                    <div>
                        <a href="index.php" target="_blank" class="btn btn-primary-custom me-2">
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
                <button class="btn btn-sm btn-primary-custom" onclick="saveSection('about')">
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
                <input type="text" class="form-control" id="address" value="195 San Lorenzo Street · G.M.A., Cavite">
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
                <textarea class="form-control" id="summary" rows="4">I have experience working in agile environments, where I analyze problems, collaborate with cross-functional teams, and deliver clear and actionable insights. I am now focused on pursuing a career as a Cybersecurity Analyst, applying analytical thinking, continuous learning, and a structured approach to identifying risks, securing systems, and supporting an organization's overall security posture.</textarea>
            </div>
        </div>

        <!-- Experience Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-briefcase"></i> Experience</h4>
                <div>
                    <button class="btn btn-sm btn-primary-custom" onclick="addExperience()">
                        <i class="fas fa-plus"></i> Add Experience
                    </button>
                </div>
            </div>
            
            <div id="experienceItems">
                <!-- Experience items will be loaded here -->
            </div>
        </div>

        <!-- Projects Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-folder"></i> Projects</h4>
                <div>
                    <button class="btn btn-sm btn-primary-custom" onclick="addProject()">
                        <i class="fas fa-plus"></i> Add Project
                    </button>
                </div>
            </div>
            
            <div id="projectsItems">
                <!-- Project items will be loaded here -->
            </div>
        </div>

        <!-- Education Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-graduation-cap"></i> Education</h4>
                <div>
                    <button class="btn btn-sm btn-primary-custom" onclick="addEducation()">
                        <i class="fas fa-plus"></i> Add Education
                    </button>
                </div>
            </div>
            
            <div id="educationItems">
                <!-- Education items will be loaded here -->
            </div>
        </div>

        <!-- Skills Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-code"></i> Skills</h4>
                <button class="btn btn-sm btn-primary-custom" onclick="saveSection('skills')">
                    <i class="fas fa-save"></i> Save Skills
                </button>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Programming Languages & Tools</label>
                <input type="text" class="form-control" id="skillsList" value="HTML, CSS, JavaScript, React, WordPress, Python">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Cybersecurity Skills</label>
                <input type="text" class="form-control" id="cyberSkills" value="Threat Monitoring & Analysis, Network Security">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Workflow Description (one per line)</label>
                <textarea class="form-control" id="workflow" rows="4">Mobile-First, Responsive Design
Cross Browser Testing & Debugging
Cross Functional Teams
Agile Development & Scrum</textarea>
            </div>
        </div>

        <!-- Interests Section Editor -->
        <div class="editor-container">
            <div class="section-header">
                <h4><i class="fas fa-heart"></i> Interests</h4>
                <button class="btn btn-sm btn-primary-custom" onclick="saveSection('interests')">
                    <i class="fas fa-save"></i> Save Interests
                </button>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Interests Description</label>
                <textarea class="form-control" id="interestsText" rows="4">As a web developer and aspiring cybersecurity professional, I spend much of my time exploring technology and building projects that enhance my skills. I enjoy staying up-to-date with the latest trends in web development, cybersecurity practices, and emerging tech innovations.

Outside of work, I enjoy outdoor activities that keep me active and inspired, such as hiking, biking, and other adventure pursuits. I also enjoy experimenting in the kitchen as an aspiring chef and following sci-fi and fantasy movies and series that spark creativity and curiosity.</textarea>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Check if user is logged in via localStorage
        if (!localStorage.getItem('resumeLoggedIn')) {
            window.location.href = 'login.php';
        }
        
        // Load saved data
        loadData();
        
        function loadData() {
            // Load About
            const about = JSON.parse(localStorage.getItem('resumeAbout'));
            if (about) {
                document.getElementById('firstName').value = about.firstName || 'Khryssha';
                document.getElementById('lastName').value = about.lastName || 'Andres';
                document.getElementById('address').value = about.address || '195 San Lorenzo Street · G.M.A., Cavite';
                document.getElementById('phone').value = about.phone || '09657098585';
                document.getElementById('email').value = about.email || 'khrysshaandres@gmail.com';
                document.getElementById('summary').value = about.summary || 'I have experience working in agile environments...';
            }
            
            // Load Experience
            loadExperience();
            
            // Load Projects
            loadProjects();
            
            // Load Education
            loadEducation();
            
            // Load Skills
            loadSkills();
            
            // Load Interests
            loadInterests();
        }
        
        function loadExperience() {
            const expList = document.getElementById('experienceItems');
            const savedExp = JSON.parse(localStorage.getItem('resumeExperience')) || [
                {
                    title: 'IT SUPPORT (SPES)',
                    company: 'GENERAL MARIANO ALVAREZ MUNICIPAL HALL, GMA, Cavite',
                    description: '● Assisted with creating UI for MSWD staff using Figma.\n● Performed troubleshooting and maintenance of computer systems and peripherals\n● Collaborated with IT team on creating survey for MSWD staff\n● Documented technical processes and created user guides for municipal staff',
                    period: 'March 2013 - Present'
                },
                {
                    title: 'Web Developer',
                    company: 'Intelitec Solutions',
                    description: 'Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.',
                    period: 'December 2011 - March 2013'
                }
            ];
            
            expList.innerHTML = '';
            savedExp.forEach((exp, index) => {
                expList.innerHTML += `
                    <div class="section-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Experience #${index + 1}</h5>
                            <button class="btn btn-sm btn-danger" onclick="removeItem('experience', ${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Job Title</label>
                                    <input type="text" class="form-control exp-title" value="${exp.title}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control exp-company" value="${exp.company}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control exp-desc" rows="4">${exp.description}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Period</label>
                            <input type="text" class="form-control exp-period" value="${exp.period}">
                        </div>
                    </div>
                `;
            });
        }
        
        function loadProjects() {
            const projList = document.getElementById('projectsItems');
            const savedProj = JSON.parse(localStorage.getItem('resumeProjects')) || [
                {
                    title: 'Order Management System',
                    description: 'Developed a full-stack web application for managing customer orders, inventory, and shipping using React, Node.js, and MongoDB.',
                    technologies: 'React, Node.js, MongoDB, Express'
                },
                {
                    title: 'Fiverr Clone',
                    description: 'Created a marketplace platform similar to Fiverr, allowing users to buy and sell services with integrated payment processing using Stripe API.',
                    technologies: 'HTML, CSS, JavaScript, PHP, MySQL'
                },
                {
                    title: 'Attendance System',
                    description: 'Designed and implemented an attendance tracking system for schools using PHP and MySQL, featuring user authentication and reporting capabilities.',
                    technologies: 'PHP, MySQL, JavaScript'
                },
                {
                    title: 'Takoyaki Web Application',
                    description: 'Built a web application for a local takoyaki business to manage orders and showcase their menu, utilizing HTML, CSS, and JavaScript.',
                    technologies: 'HTML, CSS, JavaScript'
                }
            ];
            
            projList.innerHTML = '';
            savedProj.forEach((proj, index) => {
                projList.innerHTML += `
                    <div class="section-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Project #${index + 1}</h5>
                            <button class="btn btn-sm btn-danger" onclick="removeItem('projects', ${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Project Title</label>
                            <input type="text" class="form-control proj-title" value="${proj.title}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Technologies Used</label>
                            <input type="text" class="form-control proj-tech" value="${proj.technologies || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Project Description</label>
                            <textarea class="form-control proj-desc" rows="3">${proj.description}</textarea>
                        </div>
                    </div>
                `;
            });
        }
        
        function loadEducation() {
            const eduList = document.getElementById('educationItems');
            const savedEdu = JSON.parse(localStorage.getItem('resumeEducation')) || [
                {
                    school: 'University of Colorado Boulder',
                    degree: 'Bachelor of Science',
                    details: 'Computer Science - Web Development Track',
                    gpa: 'GPA: 3.23',
                    period: 'August 2006 - May 2010'
                },
                {
                    school: 'James Buchanan High School',
                    degree: 'Technology Magnet Program',
                    details: '',
                    gpa: 'GPA: 3.56',
                    period: 'August 2002 - May 2006'
                }
            ];
            
            eduList.innerHTML = '';
            savedEdu.forEach((edu, index) => {
                eduList.innerHTML += `
                    <div class="section-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Education #${index + 1}</h5>
                            <button class="btn btn-sm btn-danger" onclick="removeItem('education', ${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School/University</label>
                            <input type="text" class="form-control edu-school" value="${edu.school}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Degree</label>
                            <input type="text" class="form-control edu-degree" value="${edu.degree}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Details</label>
                            <input type="text" class="form-control edu-details" value="${edu.details || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">GPA</label>
                            <input type="text" class="form-control edu-gpa" value="${edu.gpa || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Period</label>
                            <input type="text" class="form-control edu-period" value="${edu.period}">
                        </div>
                    </div>
                `;
            });
        }
        
        function loadSkills() {
            const skillsData = JSON.parse(localStorage.getItem('resumeSkills'));
            if (skillsData) {
                document.getElementById('skillsList').value = skillsData.skillsList || 'HTML, CSS, JavaScript, React, WordPress, Python';
                document.getElementById('cyberSkills').value = skillsData.cyberSkills || 'Threat Monitoring & Analysis, Network Security';
                document.getElementById('workflow').value = skillsData.workflow || 'Mobile-First, Responsive Design\nCross Browser Testing & Debugging\nCross Functional Teams\nAgile Development & Scrum';
            }
        }
        
        function loadInterests() {
            const interestsData = JSON.parse(localStorage.getItem('resumeInterests'));
            if (interestsData) {
                document.getElementById('interestsText').value = interestsData.text || 'As a web developer and aspiring cybersecurity professional...';
            }
        }
        
        function addExperience() {
            const savedExp = JSON.parse(localStorage.getItem('resumeExperience')) || [];
            savedExp.push({
                title: 'New Position',
                company: 'Company Name',
                description: 'Description of your role and achievements.',
                period: 'Month Year - Present'
            });
            localStorage.setItem('resumeExperience', JSON.stringify(savedExp));
            loadExperience();
            showAlert('New experience added!');
        }
        
        function addProject() {
            const savedProj = JSON.parse(localStorage.getItem('resumeProjects')) || [];
            savedProj.push({
                title: 'New Project',
                technologies: 'Technologies used',
                description: 'Description of the project and your contributions.'
            });
            localStorage.setItem('resumeProjects', JSON.stringify(savedProj));
            loadProjects();
            showAlert('New project added!');
        }
        
        function addEducation() {
            const savedEdu = JSON.parse(localStorage.getItem('resumeEducation')) || [];
            savedEdu.push({
                school: 'University Name',
                degree: 'Degree Type',
                details: 'Field of Study',
                gpa: 'GPA: 0.00',
                period: 'Month Year - Month Year'
            });
            localStorage.setItem('resumeEducation', JSON.stringify(savedEdu));
            loadEducation();
            showAlert('New education added!');
        }
        
        function removeItem(type, index) {
            if (confirm('Are you sure you want to remove this item?')) {
                if (type === 'experience') {
                    const savedExp = JSON.parse(localStorage.getItem('resumeExperience')) || [];
                    savedExp.splice(index, 1);
                    localStorage.setItem('resumeExperience', JSON.stringify(savedExp));
                    loadExperience();
                } else if (type === 'projects') {
                    const savedProj = JSON.parse(localStorage.getItem('resumeProjects')) || [];
                    savedProj.splice(index, 1);
                    localStorage.setItem('resumeProjects', JSON.stringify(savedProj));
                    loadProjects();
                } else if (type === 'education') {
                    const savedEdu = JSON.parse(localStorage.getItem('resumeEducation')) || [];
                    savedEdu.splice(index, 1);
                    localStorage.setItem('resumeEducation', JSON.stringify(savedEdu));
                    loadEducation();
                }
                showAlert('Item removed successfully!');
            }
        }
        
        function saveSection(section) {
            if (section === 'about') {
                const aboutData = {
                    firstName: document.getElementById('firstName').value,
                    lastName: document.getElementById('lastName').value,
                    address: document.getElementById('address').value,
                    phone: document.getElementById('phone').value,
                    email: document.getElementById('email').value,
                    summary: document.getElementById('summary').value
                };
                localStorage.setItem('resumeAbout', JSON.stringify(aboutData));
            } else if (section === 'skills') {
                const skillsData = {
                    skillsList: document.getElementById('skillsList').value,
                    cyberSkills: document.getElementById('cyberSkills').value,
                    workflow: document.getElementById('workflow').value
                };
                localStorage.setItem('resumeSkills', JSON.stringify(skillsData));
            } else if (section === 'interests') {
                const interestsData = {
                    text: document.getElementById('interestsText').value
                };
                localStorage.setItem('resumeInterests', JSON.stringify(interestsData));
            }
            showAlert(`${section} section saved!`);
        }
        
        function saveAllChanges() {
            // Save About
            const aboutData = {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                address: document.getElementById('address').value,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                summary: document.getElementById('summary').value
            };
            localStorage.setItem('resumeAbout', JSON.stringify(aboutData));
            
            // Save Experience
            const experienceItems = [];
            document.querySelectorAll('.section-card').forEach(item => {
                if (item.querySelector('.exp-title')) {
                    experienceItems.push({
                        title: item.querySelector('.exp-title').value,
                        company: item.querySelector('.exp-company').value,
                        description: item.querySelector('.exp-desc').value,
                        period: item.querySelector('.exp-period').value
                    });
                }
            });
            localStorage.setItem('resumeExperience', JSON.stringify(experienceItems));
            
            // Save Projects
            const projectItems = [];
            document.querySelectorAll('.section-card').forEach(item => {
                if (item.querySelector('.proj-title')) {
                    projectItems.push({
                        title: item.querySelector('.proj-title').value,
                        technologies: item.querySelector('.proj-tech').value,
                        description: item.querySelector('.proj-desc').value
                    });
                }
            });
            localStorage.setItem('resumeProjects', JSON.stringify(projectItems));
            
            // Save Education
            const educationItems = [];
            document.querySelectorAll('.section-card').forEach(item => {
                if (item.querySelector('.edu-school')) {
                    educationItems.push({
                        school: item.querySelector('.edu-school').value,
                        degree: item.querySelector('.edu-degree').value,
                        details: item.querySelector('.edu-details').value,
                        gpa: item.querySelector('.edu-gpa').value,
                        period: item.querySelector('.edu-period').value
                    });
                }
            });
            localStorage.setItem('resumeEducation', JSON.stringify(educationItems));
            
            // Save Skills
            const skillsData = {
                skillsList: document.getElementById('skillsList').value,
                cyberSkills: document.getElementById('cyberSkills').value,
                workflow: document.getElementById('workflow').value
            };
            localStorage.setItem('resumeSkills', JSON.stringify(skillsData));
            
            // Save Interests
            const interestsData = {
                text: document.getElementById('interestsText').value
            };
            localStorage.setItem('resumeInterests', JSON.stringify(interestsData));
            
            showAlert('All changes saved successfully!');
        }
        
        function showAlert(message) {
            const alert = document.getElementById('saveAlert');
            document.getElementById('alertMessage').textContent = message;
            alert.style.display = 'block';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 3000);
        }
        
        function hideAlert() {
            document.getElementById('saveAlert').style.display = 'none';
        }
    </script>
</body>
</html>
