# 🎓 Exam Management System (EMS)

[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-7.2%2B-777bb4.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-orange.svg)](https://www.mysql.com/)

A comprehensive, full-stack web application designed to automate and streamline exam scheduling, student management, and result generation for educational institutions.

---

## 🌟 Features

### 👨‍💼 Admin Features
- **Dashboard**: Quick overview of total exams, students, courses, and results.
- **Class Management**: Add and manage different classes or sections.
- **Course Management**: Define courses and assign them to specific classes.
- **Student Management**: Securely add, update, and manage student records.
- **Exam Scheduling**: Create exams with specific time limits, question counts, and marking schemes (including negative marking).
- **Question Bank**: Manage a bank of multiple-choice questions for each exam.
- **Result Analysis**: Automatically track student performance and attendance.

### 👨‍🎓 Student Features
- **Secure Login**: Individual student accounts for taking exams.
- **Exam Interface**: A user-friendly interface for taking scheduled exams with a countdown timer.
- **Instant Results**: Detailed score breakdown and answer analysis immediately after submission.
- **Profile Management**: Update personal information and profile picture.

---

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript (jQuery), Bootstrap 5, Font Awesome.
- **Backend**: PHP (7.2+ recommended).
- **Database**: MySQL.
- **Utilities**: SweetAlert for beautiful notifications, TimeCircles for the exam timer.

---

## 🚀 Getting Started

### Prerequisites
- A local PHP environment (e.g., XAMPP, WAMP, Laragon) or a web server with PHP and MySQL.

### Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/exam-management-system.git
   cd exam-management-system
   ```

2. **Database Setup**:
   - Open phpMyAdmin (or your preferred MySQL client).
   - Create a new database named `exam_management`.
   - Import the `SQL/exam_management.sql` file into the new database.

3. **Configuration**:
   - Open `connection.php`.
   - Update the database credentials to match your local setup:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "exam_management";
     ```

4. **Run the Application**:
   - Move the project folder to your server's root directory (e.g., `htdocs` in XAMPP).
   - Access the application in your browser at `http://localhost/exam-management-system`.

---

## 🔑 Default Credentials

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@email` | `1234` |
| **Student** | `student@gmail.com` | `1234` |

---

## 📁 Project Structure

```text
├── admin/            # Admin control panel files
│   ├── assets/       # Admin-specific PHP modules
│   ├── css/          # Admin stylesheets
│   ├── js/           # Admin JavaScript files
│   └── img/          # Admin images
├── student/          # Student portal files
│   ├── assets/       # Student-specific PHP modules
│   ├── img/          # Student images
│   └── ...           # Student-facing PHP pages
├── SQL/              # Database schema and initial data
├── connection.php    # Core database connection
├── data.php          # Login processing logic
├── index.php         # Landing page
├── login.php         # Unified login page
└── style.css         # Global styles
```

---

## 🛡️ Security Updates
The following areas have been enhanced for security:
- **Database Connection**: Improved error handling and character set configuration.
- **Login/Registration**: Refactored to use **Prepared Statements** to prevent SQL Injection attacks in critical authentication flows.

---

## 📜 License
This project is licensed under the [GNU General Public License v2](LICENSE).

---

## 🤝 Contributing
Contributions are welcome! Feel free to open an issue or submit a pull request.

1. Fork the Project.
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the Branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

---

## 📬 Contact
Developed by [Your Name/GitHub Handle]. Feel free to reach out for questions or support!
