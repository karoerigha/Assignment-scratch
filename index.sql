USE admissionportal;

-- Create Users Table
CREATE TABLE IF NOT EXISTS Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName NVARCHAR(50) NOT NULL,
    LastName NVARCHAR(50) NOT NULL,
    MatNumber NVARCHAR(10) UNIQUE,
    Username NVARCHAR(50) UNIQUE NOT NULL,
    Password NVARCHAR(255) NOT NULL
);

-- Create Courses Table
CREATE TABLE IF NOT EXISTS Courses (
    CourseID INT PRIMARY KEY AUTO_INCREMENT,
    CourseName NVARCHAR(100) NOT NULL
);

-- Create Grades Table
CREATE TABLE IF NOT EXISTS Grades (
    GradeID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    CourseID INT,
    Grade NVARCHAR(2) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (CourseID) REFERENCES Courses(CourseID)
);

-- Insert Sample Users
INSERT INTO Users (FirstName, LastName, MatNumber, Username, Password) VALUES
('Erigha', 'Daniel', 'psc2008146', 'Erigha', 'blessed'),
('John', 'Doe', 'edu3065125', 'john', 'password2');

-- Insert Sample Courses
INSERT INTO Courses (CourseName) VALUES
('Mathematics'), ('Computer Science'), ('Chemistry'), ('Physics'),
('English'), ('Literature'), ('Government'), ('History');

-- Insert Sample Grades
-- Assuming User with MatNumber 'psc2008146' is taking Mathematics, Computer Science, Chemistry, and Physics
INSERT INTO Grades (UserID, CourseID, Grade) VALUES
(1, 1, 'A1'), (1, 2, 'A1'), (1, 3, 'B3'), (1, 4, 'B2');

-- Assuming User with MatNumber 'edu3065125' is taking English, Literature, Government, and History
INSERT INTO Grades (UserID, CourseID, Grade) VALUES
(2, 5, 'B3'), (2, 6, 'A1'), (2, 7, 'C4'), (2, 8, 'B2');
