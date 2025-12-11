// Resume Data Structure
let resumeData = {
    name: "Khryssha Andres",
    title: "Web Developer",
    image: "https://images.unsplash.com/photo-1494790108755-2616b786d4d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80",
    email: "khrysshaandres@gmail.com",
    phone: "09657098585",
    address: "195 San Lorenzo Street, G.M.A., AVITE",
    about: "I am experienced in leveraging agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.",
    experience: [
        {
            id: 1,
            title: "Senior Web Developer",
            company: "Intelitec Solutions",
            description: "Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution.",
            period: "March 2013 - Present"
        },
        {
            id: 2,
            title: "Web Developer",
            company: "Intelitec Solutions",
            description: "Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps.",
            period: "December 2011 - March 2013"
        }
    ],
    education: [
        {
            id: 1,
            school: "University of Colorado Boulder",
            degree: "Bachelor of Science",
            field: "Computer Science - Web Development Track",
            period: "August 2006 - May 2010"
        },
        {
            id: 2,
            school: "James Buchanan High School",
            degree: "Technology Magnet Program",
            field: "",
            period: "August 2002 - May 2006"
        }
    ],
    skills: ["HTML5", "CSS3", "JavaScript", "React", "Node.js", "Git", "Responsive Design", "UI/UX"],
    social: {
        linkedin: "https://linkedin.com",
        github: "https://github.com",
        twitter: "https://twitter.com",
        facebook: "https://facebook.com"
    },
    lastUpdated: new Date().toLocaleDateString()
};

// Check if we're on edit page
const isEditPage = window.location.pathname.includes('edit.php');

// Load data from localStorage if available
function loadData() {
    const savedData = localStorage.getItem('resumeData');
    if (savedData) {
        resumeData = JSON.parse(savedData);
    }
    
    if (isEditPage) {
        loadEditForm();
    } else {
        loadResume();
    }
}

// Load resume on index.php
function loadResume() {
    // Basic Info
    document.getElementById('name').textContent = resumeData.name;
    document.getElementById('title').textContent = resumeData.title;
    document.getElementById('profile-img').src = resumeData.image;
    document.getElementById('about-text').textContent = resumeData.about;
    document.getElementById('last-updated').textContent = resumeData.lastUpdated;
    
    // Contact Info
    const contactHtml = `
        <p><i class="fas fa-envelope"></i> ${resumeData.email}</p>
        <p><i class="fas fa-phone"></i> ${resumeData.phone}</p>
        <p><i class="fas fa-map-marker-alt"></i> ${resumeData.address}</p>
    `;
    document.getElementById('contact-info').innerHTML = contactHtml;
    
    // Experience
    const experienceHtml = resumeData.experience.map(exp => `
        <div class="experience-item">
            <h3>${exp.title}</h3>
            <p class="company">${exp.company}</p>
            <p class="period">${exp.period}</p>
            <p>${exp.description}</p>
        </div>
    `).join('');
    document.getElementById('experience-section').innerHTML = experienceHtml;
    
    // Education
    const educationHtml = resumeData.education.map(edu => `
        <div class="education-item">
            <h3>${edu.school}</h3>
            <p class="school">${edu.degree}${edu.field ? ` - ${edu.field}` : ''}</p>
            <p class="period">${edu.period}</p>
        </div>
    `).join('');
    document.getElementById('education-section').innerHTML = educationHtml;
    
    // Skills
    const skillsHtml = resumeData.skills.map(skill => `
        <span class="skill-tag">${skill}</span>
    `).join('');
    document.getElementById('skills-section').innerHTML = skillsHtml;
    
    // Social Links
    const socialHtml = `
        <a href="${resumeData.social.linkedin}" class="social-link" target="_blank">
            <i class="fab fa-linkedin"></i> LinkedIn
        </a>
        <a href="${resumeData.social.github}" class="social-link" target="_blank">
            <i class="fab fa-github"></i> GitHub
        </a>
        <a href="${resumeData.social.twitter}" class="social-link" target="_blank">
            <i class="fab fa-twitter"></i> Twitter
        </a>
        <a href="${resumeData.social.facebook}" class="social-link" target="_blank">
            <i class="fab fa-facebook"></i> Facebook
        </a>
    `;
    document.getElementById('social-links').innerHTML = socialHtml;
}

// Load data into edit form
function loadEditForm() {
    // Check if user is logged in
    if (!localStorage.getItem('isLoggedIn')) {
        window.location.href = 'login.php';
        return;
    }
    
    // Basic Info
    document.getElementById('edit-name').value = resumeData.name;
    document.getElementById('edit-title').value = resumeData.title;
    document.getElementById('edit-image').value = resumeData.image;
    document.getElementById('edit-about').value = resumeData.about;
    document.getElementById('edit-email').value = resumeData.email;
    document.getElementById('edit-phone').value = resumeData.phone;
    document.getElementById('edit-address').value = resumeData.address;
    
    // Skills
    document.getElementById('edit-skills').value = resumeData.skills.join(', ');
    
    // Social Links
    document.getElementById('edit-linkedin').value = resumeData.social.linkedin;
    document.getElementById('edit-github').value = resumeData.social.github;
    document.getElementById('edit-twitter').value = resumeData.social.twitter;
    document.getElementById('edit-facebook').value = resumeData.social.facebook;
    
    // Load Experience
    loadExperienceEdit();
    
    // Load Education
    loadEducationEdit();
}

// Load experience in edit form
function loadExperienceEdit() {
    const container = document.getElementById('experience-edit-container');
    container.innerHTML = resumeData.experience.map(exp => `
        <div class="edit-item" data-id="${exp.id}">
            <div class="form-row">
                <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" class="edit-input edit-exp-title" value="${exp.title}">
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="edit-input edit-exp-company" value="${exp.company}">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="edit-textarea edit-exp-desc" rows="3">${exp.description}</textarea>
            </div>
            <div class="form-group">
                <label>Period</label>
                <input type="text" class="edit-input edit-exp-period" value="${exp.period}" placeholder="e.g., March 2013 - Present">
            </div>
            <div class="item-actions">
                <button class="btn-delete" onclick="deleteExperience(${exp.id})">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        </div>
    `).join('');
}

// Load education in edit form
function loadEducationEdit() {
    const container = document.getElementById('education-edit-container');
    container.innerHTML = resumeData.education.map(edu => `
        <div class="edit-item" data-id="${edu.id}">
            <div class="form-row">
                <div class="form-group">
                    <label>School Name</label>
                    <input type="text" class="edit-input edit-edu-school" value="${edu.school}">
                </div>
                <div class="form-group">
                    <label>Degree</label>
                    <input type="text" class="edit-input edit-edu-degree" value="${edu.degree}">
                </div>
            </div>
            <div class="form-group">
                <label>Field of Study</label>
                <input type="text" class="edit-input edit-edu-field" value="${edu.field}">
            </div>
            <div class="form-group">
                <label>Period</label>
                <input type="text" class="edit-input edit-edu-period" value="${edu.period}" placeholder="e.g., August 2006 - May 2010">
            </div>
            <div class="item-actions">
                <button class="btn-delete" onclick="deleteEducation(${edu.id})">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        </div>
    `).join('');
}

// Add new experience
function addExperience() {
    const newId = resumeData.experience.length > 0 
        ? Math.max(...resumeData.experience.map(e => e.id)) + 1 
        : 1;
    
    resumeData.experience.push({
        id: newId,
        title: "New Position",
        company: "Company Name",
        description: "Describe your responsibilities and achievements",
        period: "Month Year - Present"
    });
    
    loadExperienceEdit();
}

// Delete experience
function deleteExperience(id) {
    if (confirm("Are you sure you want to delete this experience?")) {
        resumeData.experience = resumeData.experience.filter(exp => exp.id !== id);
        loadExperienceEdit();
    }
}

// Add new education
function addEducation() {
    const newId = resumeData.education.length > 0 
        ? Math.max(...resumeData.education.map(e => e.id)) + 1 
        : 1;
    
    resumeData.education.push({
        id: newId,
        school: "University Name",
        degree: "Degree Level",
        field: "Field of Study",
        period: "Start Year - End Year"
    });
    
    loadEducationEdit();
}

// Delete education
function deleteEducation(id) {
    if (confirm("Are you sure you want to delete this education?")) {
        resumeData.education = resumeData.education.filter(edu => edu.id !== id);
        loadEducationEdit();
    }
}

// Save all changes
function saveAll() {
    // Update basic info
    resumeData.name = document.getElementById('edit-name').value;
    resumeData.title = document.getElementById('edit-title').value;
    resumeData.image = document.getElementById('edit-image').value;
    resumeData.about = document.getElementById('edit-about').value;
    resumeData.email = document.getElementById('edit-email').value;
    resumeData.phone = document.getElementById('edit-phone').value;
    resumeData.address = document.getElementById('edit-address').value;
    
    // Update skills
    const skillsText = document.getElementById('edit-skills').value;
    resumeData.skills = skillsText.split(',').map(skill => skill.trim()).filter(skill => skill);
    
    // Update social links
    resumeData.social.linkedin = document.getElementById('edit-linkedin').value;
    resumeData.social.github = document.getElementById('edit-github').value;
    resumeData.social.twitter = document.getElementById('edit-twitter').value;
    resumeData.social.facebook = document.getElementById('edit-facebook').value;
    
    // Update experience
    const experienceItems = document.querySelectorAll('.edit-item[data-id]');
    experienceItems.forEach(item => {
        const id = parseInt(item.getAttribute('data-id'));
        const exp = resumeData.experience.find(e => e.id === id);
        if (exp) {
            exp.title = item.querySelector('.edit-exp-title').value;
            exp.company = item.querySelector('.edit-exp-company').value;
            exp.description = item.querySelector('.edit-exp-desc').value;
            exp.period = item.querySelector('.edit-exp-period').value;
        }
    });
    
    // Update education
    const educationItems = document.querySelectorAll('.edit-item[data-id]');
    educationItems.forEach(item => {
        const id = parseInt(item.getAttribute('data-id'));
        const edu = resumeData.education.find(e => e.id === id);
        if (edu) {
            edu.school = item.querySelector('.edit-edu-school').value;
            edu.degree = item.querySelector('.edit-edu-degree').value;
            edu.field = item.querySelector('.edit-edu-field').value;
            edu.period = item.querySelector('.edit-edu-period').value;
        }
    });
    
    // Update timestamp
    resumeData.lastUpdated = new Date().toLocaleDateString();
    
    // Save to localStorage
    localStorage.setItem('resumeData', JSON.stringify(resumeData));
    
    // Show success message
    const status = document.getElementById('save-status');
    status.textContent = "Changes saved successfully!";
    status.className = "save-status save-success";
    
    // Clear message after 3 seconds
    setTimeout(() => {
        status.textContent = "";
        status.className = "save-status";
    }, 3000);
}

// Initialize
window.onload = loadData;