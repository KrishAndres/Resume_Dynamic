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
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Resume </title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Khryssha Andres</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/profile.png" alt="..." /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#interests">Interests</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Projects</a></li>

                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        Khryssha
                        <span class="text-primary">Andres</span>
                    </h1>
                    <div class="subheading mb-5">
                        195 San Lorenzo Street · G.M.A., Cavite · 09657098585 ·
                        <a href="mailto:name@email.com">khrysshaandres@gmail.com</a>
                    </div>
                    <p class="lead mb-5">I have experience working in agile environments, where I analyze problems, collaborate with cross-functional teams, and deliver clear and actionable insights. I am now focused on pursuing a career as a Cybersecurity Analyst, applying analytical thinking, continuous learning, and a structured approach to identifying risks, securing systems, and supporting an organization’s overall security posture.</p>
                    <div class="social-icons">
                        <a class="social-icon" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-github"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Experience-->
            <section class="resume-section" id="experience">
                <div class="resume-section-content">
                    <h2 class="mb-5">Experience</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">IT SUPPORT (SPES)</h3>
                            <div class="subheading mb-3">GENERAL MARIANO ALVAREZ MUNICIPAL HALL, GMA, Cavite</div>
                            <p>● Assisted with creating UI for MSWD staff using Figma.
                                ● Performed troubleshooting and maintenance of computer systems and peripherals
                                ● Collaborated with IT team on creating survey for MSWD staff
                                ● Documented technical processes and created user guides for municipal staff</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">March 2013 - Present</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Web Developer</h3>
                            <div class="subheading mb-3">Intelitec Solutions</div>
                            <p>Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">December 2011 - March 2013</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Junior Web Designer</h3>
                            <div class="subheading mb-3">Shout! Media Productions</div>
                            <p>Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">July 2010 - December 2011</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Web Design Intern</h3>
                            <div class="subheading mb-3">Shout! Media Productions</div>
                            <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">September 2008 - June 2010</span></div>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Education-->
            <section class="resume-section" id="education">
                <div class="resume-section-content">
                    <h2 class="mb-5">Education</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">University of Colorado Boulder</h3>
                            <div class="subheading mb-3">Bachelor of Science</div>
                            <div>Computer Science - Web Development Track</div>
                            <p>GPA: 3.23</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">August 2006 - May 2010</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">James Buchanan High School</h3>
                            <div class="subheading mb-3">Technology Magnet Program</div>
                            <p>GPA: 3.56</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">August 2002 - May 2006</span></div>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Skills-->
            <section class="resume-section" id="skills">
                <div class="resume-section-content">
                    <h2 class="mb-5">Skills</h2>
                    <div class="subheading mb-3">Programming Languages & Tools</div>
                    <ul class="list-inline dev-icons">
                      <li class="list-inline-item"><i class="fab fa-html5"></i></li>
                        <li class="list-inline-item"><i class="fab fa-css3-alt"></i></li>
                        <li class="list-inline-item"><i class="fab fa-js-square"></i></li>
                        <li class="list-inline-item"><i class="fab fa-react"></i></li>
                        <li class="list-inline-item"><i class="fab fa-wordpress"></i></li>
                        <li class="list-inline-item"><i class="fab fa-python"></i></li>

                        <!-- Cybersecurity Skills -->
                        <li class="list-inline-item"><i class="fas fa-shield-alt" title="Threat Monitoring & Analysis"></i></li>
                        <li class="list-inline-item"><i class="fas fa-network-wired" title="Network Security"></i></li>

                    </ul>
                    <div class="subheading mb-3">Workflow</div>
                    <ul class="fa-ul mb-0">
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Mobile-First, Responsive Design
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Cross Browser Testing & Debugging
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Cross Functional Teams
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Agile Development & Scrum
                        </li>
                    </ul>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Interests-->
            <section class="resume-section" id="interests">
                <div class="resume-section-content">
                    <h2 class="mb-5">Interests</h2>
                    <p><p class="mb-0">
                        As a web developer and aspiring cybersecurity professional, I spend much of my time exploring technology and building projects that enhance my skills. I enjoy staying up-to-date with the latest trends in web development, cybersecurity practices, and emerging tech innovations.
                        </p>
                        <p class="mb-0">
                        Outside of work, I enjoy outdoor activities that keep me active and inspired, such as hiking, biking, and other adventure pursuits. I also enjoy experimenting in the kitchen as an aspiring chef and following sci-fi and fantasy movies and series that spark creativity and curiosity.
                        </p>
            </section>
            <hr class="m-0" />
            <!-- Projects-->
            <section class="resume-section" id="projects">
                <div class="resume-section-content">
                    <h2 class="mb-5">Projects</h2>
                    <ul class="fa-ul mb-0">
                        <li>
                            <span class="fa-li"><i class="fas fa-folder text-warning"></i></span>
                            Order Management System - Developed a full-stack web application for managing customer orders, inventory, and shipping using React, Node.js, and MongoDB.
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-folder text-warning"></i></span>
                            Fiverr Clone - Created a marketplace platform similar to Fiverr, allowing users to buy and sell services with integrated payment processing using Stripe API.
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-folder text-warning"></i></span>
                            
                            Attendance System - Designed and implemented an attendance tracking system for schools using PHP and MySQL, featuring user authentication and reporting capabilities.
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-folder text-warning"></i></span>
                            
                            Takoyaki Web Application - Built a web application for a local takoyaki business to manage orders and showcase their menu, utilizing HTML, CSS, and JavaScript.
                        </li>
                      
                    </ul>
                </div>
            </section>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <!-- DYNAMIC FUNCTIONALITY SCRIPT - Add this before </body> -->
<script>
// Check login and add edit button
document.addEventListener('DOMContentLoaded', function() {
    // Show edit button if logged in
    if (localStorage.getItem('resumeLoggedIn') === 'true') {
        const editButton = document.createElement('a');
        editButton.href = 'admin.php';
        editButton.className = 'edit-resume-btn';
        editButton.innerHTML = '<i class="fas fa-edit"></i> Edit Resume';
        editButton.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #bd5d38 0%, #a0522d 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            font-family: 'Muli', sans-serif;
        `;
        editButton.onmouseover = function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 6px 15px rgba(0,0,0,0.25)';
        };
        editButton.onmouseout = function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
        };
        document.body.appendChild(editButton);
    }
    
    // Also add login button if not logged in
    else {
        const loginButton = document.createElement('a');
        loginButton.href = 'login.php';
        loginButton.className = 'login-resume-btn';
        loginButton.innerHTML = '<i class="fas fa-sign-in-alt"></i> Admin Login';
        loginButton.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #495057;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            z-index: 9999;
            font-size: 14px;
            font-family: 'Muli', sans-serif;
        `;
        document.body.appendChild(loginButton);
    }
    
    // Load dynamic content
    loadDynamicContent();
});

function loadDynamicContent() {
    // Load About Section
    const aboutData = JSON.parse(localStorage.getItem('resumeAbout'));
    if (aboutData) {
        // Update name in About section
        const nameElement = document.querySelector('#about h1');
        if (nameElement) {
            nameElement.innerHTML = `
                ${aboutData.firstName}
                <span class="text-primary">${aboutData.lastName}</span>
            `;
        }
        
        // Update contact info
        const contactElement = document.querySelector('#about .subheading.mb-5');
        if (contactElement) {
            contactElement.innerHTML = `
                ${aboutData.address} · ${aboutData.phone} ·
                <a href="mailto:${aboutData.email}">${aboutData.email}</a>
            `;
        }
        
        // Update summary
        const summaryElement = document.querySelector('#about .lead.mb-5');
        if (summaryElement) {
            summaryElement.textContent = aboutData.summary;
        }
        
        // Update navigation name
        const navName = document.querySelector('.d-block.d-lg-none');
        if (navName) {
            navName.textContent = aboutData.firstName + ' ' + aboutData.lastName;
        }
    }
    
    // Load Experience
    const experienceData = JSON.parse(localStorage.getItem('resumeExperience'));
    if (experienceData && experienceData.length > 0) {
        const experienceSection = document.getElementById('experience');
        if (experienceSection) {
            const contentDiv = experienceSection.querySelector('.resume-section-content');
            let experienceHTML = '<h2 class="mb-5">Experience</h2>';
            
            experienceData.forEach((exp, index) => {
                experienceHTML += `
                    <div class="d-flex flex-column flex-md-row justify-content-between ${index < experienceData.length - 1 ? 'mb-5' : ''}">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">${exp.title}</h3>
                            <div class="subheading mb-3">${exp.company}</div>
                            <p>${exp.description}</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">${exp.period}</span></div>
                    </div>
                `;
            });
            
            contentDiv.innerHTML = experienceHTML;
        }
    }
    
    // Load Education
    const educationData = JSON.parse(localStorage.getItem('resumeEducation'));
    if (educationData && educationData.length > 0) {
        const educationSection = document.getElementById('education');
        if (educationSection) {
            const contentDiv = educationSection.querySelector('.resume-section-content');
            let educationHTML = '<h2 class="mb-5">Education</h2>';
            
            educationData.forEach((edu, index) => {
                educationHTML += `
                    <div class="d-flex flex-column flex-md-row justify-content-between ${index < educationData.length - 1 ? 'mb-5' : ''}">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">${edu.school}</h3>
                            <div class="subheading mb-3">${edu.degree}</div>
                            <div>${edu.details || 'Computer Science - Web Development Track'}</div>
                            <p>${edu.gpa || 'GPA: 3.23'}</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">${edu.period}</span></div>
                    </div>
                `;
            });
            
            contentDiv.innerHTML = educationHTML;
        }
    }
    // Load Projects
const projectsData = JSON.parse(localStorage.getItem('resumeProjects'));
if (projectsData && projectsData.length > 0) {
    const projectsSection = document.getElementById('projects');
    if (projectsSection) {
        const contentDiv = projectsSection.querySelector('.resume-section-content');
        let projectsHTML = '<h2 class="mb-5">Projects</h2><ul class="fa-ul mb-0">';
        
        projectsData.forEach((proj) => {
            projectsHTML += `
                <li>
                    <span class="fa-li"><i class="fas fa-folder text-warning"></i></span>
                    <strong>${proj.title}</strong> - ${proj.technologies ? `(${proj.technologies}) ` : ''}${proj.description}
                </li>
            `;
        });
        
        projectsHTML += '</ul>';
        contentDiv.innerHTML = projectsHTML;
    }
}
    // Load Skills
    const skillsData = JSON.parse(localStorage.getItem('resumeSkills'));
    if (skillsData) {
        // Update skills list in Skills section
        const skillsSection = document.getElementById('skills');
        if (skillsSection) {
            const contentDiv = skillsSection.querySelector('.resume-section-content');
            
            if (skillsData.skillsList) {
                // Update workflow list
                const workflowList = contentDiv.querySelector('.fa-ul.mb-0');
                if (workflowList && skillsData.workflow) {
                    const workflowItems = skillsData.workflow.split(',').map(item => item.trim());
                    let workflowHTML = '';
                    
                    workflowItems.forEach(item => {
                        workflowHTML += `
                            <li>
                                <span class="fa-li"><i class="fas fa-check"></i></span>
                                ${item}
                            </li>
                        `;
                    });
                    
                    workflowList.innerHTML = workflowHTML;
                }
            }
        }
    }
}
</script>
<!-- END DYNAMIC SCRIPT -->
 
    </body>
</html>
