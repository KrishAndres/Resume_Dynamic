-- Create database
CREATE DATABASE IF NOT EXISTS dynamic_resume;
USE dynamic_resume;

-- Users table for authentication
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- About section
CREATE TABLE about (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    title VARCHAR(100),
    address TEXT,
    phone VARCHAR(20),
    email VARCHAR(100),
    summary TEXT,
    linkedin VARCHAR(200),
    github VARCHAR(200),
    twitter VARCHAR(200),
    facebook VARCHAR(200)
);

-- Experience section
CREATE TABLE experiences (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100),
    company VARCHAR(100),
    description TEXT,
    start_date VARCHAR(20),
    end_date VARCHAR(20),
    display_order INT DEFAULT 0
);

-- Education section
CREATE TABLE education (
    id INT PRIMARY KEY AUTO_INCREMENT,
    school VARCHAR(100),
    degree VARCHAR(100),
    major VARCHAR(100),
    gpa VARCHAR(10),
    start_year VARCHAR(20),
    end_year VARCHAR(20),
    display_order INT DEFAULT 0
);

-- Skills section
CREATE TABLE skills (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(50),
    name VARCHAR(100),
    icon_class VARCHAR(100),
    display_order INT DEFAULT 0
);

-- Interests section
CREATE TABLE interests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    additional TEXT
);

-- Insert default user (password: admin123)
INSERT INTO users (username, password, email) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com');

-- Insert default about data
INSERT INTO about (first_name, last_name, title, address, phone, email, summary, linkedin, github, twitter, facebook) 
VALUES 
('Khryssha', 'Andres', 'Senior Web Developer', 
 '195 San Lorenzo Street · G.M.A., Cavite', 
 '09657098585', 
 'khrysshaandres@gmail.com',
 'I am experienced in leveraging agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.',
 '#', '#', '#', '#');

-- Insert default experiences
INSERT INTO experiences (title, company, description, start_date, end_date, display_order) VALUES
('Senior Web Developer', 'Intelitec Solutions', 'Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring.', 'March 2013', 'Present', 1),
('Web Developer', 'Intelitec Solutions', 'Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.', 'December 2011', 'March 2013', 2),
('Junior Web Designer', 'Shout! Media Productions', 'Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.', 'July 2010', 'December 2011', 3);

-- Insert default education
INSERT INTO education (school, degree, major, gpa, start_year, end_year, display_order) VALUES
('University of Colorado Boulder', 'Bachelor of Science', 'Computer Science - Web Development Track', '3.23', 'August 2006', 'May 2010', 1),
('James Buchanan High School', 'Technology Magnet Program', '', '3.56', 'August 2002', 'May 2006', 2);

-- Insert default skills
INSERT INTO skills (category, name, icon_class, display_order) VALUES
('icon', 'HTML5', 'fab fa-html5', 1),
('icon', 'CSS3', 'fab fa-css3-alt', 2),
('icon', 'JavaScript', 'fab fa-js-square', 3),
('icon', 'Angular', 'fab fa-angular', 4),
('icon', 'React', 'fab fa-react', 5),
('icon', 'Node.js', 'fab fa-node-js', 6),
('workflow', 'Mobile-First, Responsive Design', 'fas fa-check', 1),
('workflow', 'Cross Browser Testing & Debugging', 'fas fa-check', 2),
('workflow', 'Cross Functional Teams', 'fas fa-check', 3),
('workflow', 'Agile Development & Scrum', 'fas fa-check', 4);

-- Insert default interests
INSERT INTO interests (content, additional) VALUES
('Apart from being a web developer, I enjoy most of my time being outdoors. In the winter, I am an avid skier and novice ice climber. During the warmer months here in Colorado, I enjoy mountain biking, free climbing, and kayaking.',
 'When forced indoors, I follow a number of sci-fi and fantasy genre movies and television shows, I am an aspiring chef, and I spend a large amount of my free time exploring the latest technology advancements in the front-end web development world.');