# EDUCA - E-Learning Website

## Overview
This Laravel project is designed for an e-learning platform, facilitating various functionalities for Admin, Lecturer, and Student roles. It includes a built-in chat feature for staff members. This document provides a guide to set up the project locally and outlines the features available for each user role.

## Getting Started

### Prerequisites
- PHP >= 7.3
- Composer
- Laravel
- MySQL (or another compatible database)

### Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/felikay/educa.git
   cd educa
   ```

2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Set Up Environment**

   Copy the `.env.example` file and make the necessary changes in the `.env` file.

   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations and Seeders**

   ```bash
   php artisan migrate --seed
   ```

6. **Serve the Application**

   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`.

## Features

### Admin
- **Create Timetable:** Admin can create and manage the timetable for different classes.
- **Add Students:** Ability to add students to the system.
- **Send Emails:** Sending emails to accepted students.
- **Assign Lecturers:** Assigning lecturers to specific classes.
- **Delete User:** Ability to remove a user from the system.

### Lecturer
- **Add Students to Class:** Lecturers can add students to their respective classes.
- **Upload Reading Materials:** Ability to upload reading materials for students.
- **Create Exams:** Designing and creating exams for classes.
- **Handle Attendance:** Managing class attendance records.
- **Handle Exam Results:** Processing and recording student exam results.

### Student
- **Submit Assignments:** Students can submit assignments through the platform.
- **Enrol in Classes:** Ability to enrol in various classes offered.

### Staff Chat
- A built-in chat feature is available for staff members for effective communication.
