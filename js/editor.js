// FILE: js/editor.js
// Resume editor functionality

const ResumeEditor = {
    // Save all changes to localStorage
    saveAllChanges: function() {
        // Save About section
        const aboutData = {
            firstName: document.getElementById('firstName').value,
            lastName: document.getElementById('lastName').value,
            address: document.getElementById('address').value,
            phone: document.getElementById('phone').value,
            email: document.getElementById('email').value,
            summary: document.getElementById('summary').value
        };
        localStorage.setItem('resumeAbout', JSON.stringify(aboutData));
        
        // Save Skills
        const skillsData = {
            skillsList: document.getElementById('skillsList').value,
            workflow: document.getElementById('workflow').value
        };
        localStorage.setItem('resumeSkills', JSON.stringify(skillsData));
        
        // Save Experience
        this.saveExperience();
        
        // Save Education
        this.saveEducation();
        
        // Show success message
        this.showAlert('All changes saved successfully!', 'success');
        
        // Update the main resume page if it's open
        this.updateResumePage();
    },
    
    // Save specific section
    saveSection: function(section) {
        switch(section) {
            case 'about':
                const aboutData = {
                    firstName: document.getElementById('firstName').value,
                    lastName: document.getElementById('lastName').value,
                    address: document.getElementById('address').value,
                    phone: document.getElementById('phone').value,
                    email: document.getElementById('email').value,
                    summary: document.getElementById('summary').value
                };
                localStorage.setItem('resumeAbout', JSON.stringify(aboutData));
                break;
            case 'skills':
                const skillsData = {
                    skillsList: document.getElementById('skillsList').value,
                    workflow: document.getElementById('workflow').value
                };
                localStorage.setItem('resumeSkills', JSON.stringify(skillsData));
                break;
        }
        
        this.showAlert(`${section} section saved!`, 'success');
        this.updateResumePage();
    },
    
    // Experience management
    saveExperience: function() {
        const experienceItems = [];
        document.querySelectorAll('.experience-item').forEach(item => {
            experienceItems.push({
                title: item.querySelector('.exp-title').value,
                company: item.querySelector('.exp-company').value,
                description: item.querySelector('.exp-desc').value,
                period: item.querySelector('.exp-period').value
            });
        });
        localStorage.setItem('resumeExperience', JSON.stringify(experienceItems));
    },
    
    addExperience: function() {
        const container = document.getElementById('experienceItems');
        const index = container.children.length;
        
        const item = document.createElement('div');
        item.className = 'experience-item section-card';
        item.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Experience #${index + 1}</h5>
                <button class="btn btn-sm btn-danger" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Job Title</label>
                        <input type="text" class="form-control exp-title" value="Senior Web Developer">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control exp-company" value="Intelitec Solutions">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control exp-desc" rows="3">Bring to the table win-win survival strategies to ensure proactive domination.</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Period</label>
                <input type="text" class="form-control exp-period" value="March 2013 - Present">
            </div>
        `;
        container.appendChild(item);
    },
    
    // Education management
    saveEducation: function() {
        const educationItems = [];
        document.querySelectorAll('.education-item').forEach(item => {
            educationItems.push({
                school: item.querySelector('.edu-school').value,
                degree: item.querySelector('.edu-degree').value,
                details: item.querySelector('.edu-details').value,
                period: item.querySelector('.edu-period').value
            });
        });
        localStorage.setItem('resumeEducation', JSON.stringify(educationItems));
    },
    
    addEducation: function() {
        const container = document.getElementById('educationItems');
        const index = container.children.length;
        
        const item = document.createElement('div');
        item.className = 'education-item section-card';
        item.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Education #${index + 1}</h5>
                <button class="btn btn-sm btn-danger" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
            <div class="mb-3">
                <label class="form-label">School/University</label>
                <input type="text" class="form-control edu-school" value="University of Colorado Boulder">
            </div>
            <div class="mb-3">
                <label class="form-label">Degree</label>
                <input type="text" class="form-control edu-degree" value="Bachelor of Science">
            </div>
            <div class="mb-3">
                <label class="form-label">Details</label>
                <input type="text" class="form-control edu-details" value="Computer Science - Web Development Track">
            </div>
            <div class="mb-3">
                <label class="form-label">Period</label>
                <input type="text" class="form-control edu-period" value="August 2006 - May 2010">
            </div>
        `;
        container.appendChild(item);
    },
    
    // Load saved data
    loadSavedData: function() {
        // Load About section
        const aboutData = JSON.parse(localStorage.getItem('resumeAbout'));
        if (aboutData) {
            document.getElementById('firstName').value = aboutData.firstName || 'Khryssha';
            document.getElementById('lastName').value = aboutData.lastName || 'Andres';
            document.getElementById('address').value = aboutData.address || '195 San Lorenzo Street · G.M.A., AVITE';
            document.getElementById('phone').value = aboutData.phone || '09657098585';
            document.getElementById('email').value = aboutData.email || 'khrysshaandres@gmail.com';
            document.getElementById('summary').value = aboutData.summary || 'I am experienced in leveraging agile frameworks...';
        }
        
        // Load Skills
        const skillsData = JSON.parse(localStorage.getItem('resumeSkills'));
        if (skillsData) {
            document.getElementById('skillsList').value = skillsData.skillsList || 'HTML, CSS, JavaScript, Angular, React, Node.js, Sass, WordPress';
            document.getElementById('workflow').value = skillsData.workflow || 'Mobile-First, Responsive Design...';
        }
        
        // Load Experience
        const experienceData = JSON.parse(localStorage.getItem('resumeExperience'));
        if (experienceData && experienceData.length > 0) {
            experienceData.forEach((exp, index) => {
                this.addExperience();
                const items = document.querySelectorAll('.experience-item');
                if (items[index]) {
                    items[index].querySelector('.exp-title').value = exp.title;
                    items[index].querySelector('.exp-company').value = exp.company;
                    items[index].querySelector('.exp-desc').value = exp.description;
                    items[index].querySelector('.exp-period').value = exp.period;
                }
            });
        } else {
            // Add default experience
            this.addExperience();
        }
        
        // Load Education
        const educationData = JSON.parse(localStorage.getItem('resumeEducation'));
        if (educationData && educationData.length > 0) {
            educationData.forEach((edu, index) => {
                this.addEducation();
                const items = document.querySelectorAll('.education-item');
                if (items[index]) {
                    items[index].querySelector('.edu-school').value = edu.school;
                    items[index].querySelector('.edu-degree').value = edu.degree;
                    items[index].querySelector('.edu-details').value = edu.details;
                    items[index].querySelector('.edu-period').value = edu.period;
                }
            });
        } else {
            // Add default education
            this.addEducation();
        }
    },
    
    // Show alert message
    showAlert: function(message, type) {
        const alert = document.getElementById('saveAlert');
        alert.textContent = message;
        alert.className = `save-alert alert alert-${type} alert-dismissible fade show`;
        alert.style.display = 'block';
        
        setTimeout(() => {
            alert.style.display = 'none';
        }, 3000);
    },
    
    // Update the main resume page
    updateResumePage: function() {
        // This would update the main resume page if it's open
        // For demo, we'll just log it
        console.log('Resume data updated');
    }
};

// Initialize editor when page loads
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('admin')) {
        ResumeEditor.loadSavedData();
    }
});

// Global functions for buttons
function saveAllChanges() {
    ResumeEditor.saveAllChanges();
}

function saveSection(section) {
    ResumeEditor.saveSection(section);
}

function saveSkills() {
    ResumeEditor.saveSection('skills');
}

function addExperience() {
    ResumeEditor.addExperience();
}

function addEducation() {
    ResumeEditor.addEducation();
}

function hideAlert() {
    document.getElementById('saveAlert').style.display = 'none';
}