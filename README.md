# 🎓 Simple Student Management System (StudentMS)

### 📌 Midterm Project Assignment

A web-based **Student Management System** developed using the **Laravel** framework and **Tailwind CSS**. This application implements the core principles of back-end and front-end development, demonstrating **MVC Architecture**, **Database Migrations**, **Eloquent ORM**, **Resource Routing**, **Form Validation**, and **Responsive UI UX Design**.

---

## 🌟 Key Features Implemented

*   **Premium Glassmorphic UI Dashboard**: A highly polished, modern dark-mode user interface designed using curated slate/indigo gradients and backdrop-blur glass panels.
*   **Complete CRUD Operations**: Add new students, list students dynamically, edit student details, and safely delete student records.
*   **Robust Input Validation**: Strict validation schemas verifying:
    *   `Name` is required, a string, and has a minimum length.
    *   `Email` is a valid format, required, and **unique** in the database.
    *   `Age` is a valid integer between 5 and 120 years.
*   **Safety Deletion Prompt**: Fulfills the project criteria using a premium custom glassmorphic warning modal asking for administrative confirmation before deleting a student record.
*   **Live Table Search Filtering**: Super-fast real-time search filtering by Name or Email address utilizing lightweight, highly optimized client-side JavaScript.
*   **Real-time Statistics Grid**: Displays active counts for *Total Registered Students*, *Average Student Age*, and *Age Distribution limits (Min/Max)*.
*   **Auto-dismissing Flash Alerts**: Delivers beautiful animated alert indicators upon successful creation, update, or deletion of a student record.

---

## System Description

StudentMS is a single-role admin interface for managing student records. It follows Laravel's MVC pattern with resourceful routing: requests are mapped in `routes/web.php`, handled by `StudentController`, persisted through the `Student` model, and rendered using Blade views. The dashboard (index page) is the hub for listing, searching, and reviewing summary stats, while create/edit pages focus on validated data entry.

## Core User Flows

1. **Landing and listing**: Open `/` and get redirected to the students dashboard, which lists records ordered by newest first.
2. **Create student**: Navigate to the create form, submit details, validate input, create the record, and return to the dashboard with a success message.
3. **Edit student**: Open a student record, update fields, validate input (including unique email for other records), save changes, and return with a success message.
4. **Delete student**: Trigger the delete action, confirm via the safety prompt, delete the record, and return to the dashboard with a success message.
5. **Search and stats**: Use the dashboard search to filter by name or email, while the statistics grid summarizes the currently loaded student data.
6. **Validation feedback**: Any invalid input returns the form with clear, field-level validation messages.

## Feature Details

*   **Resourceful routing**: `Route::resource('students', StudentController::class)` exposes the standard REST endpoints for CRUD operations.
*   **Consistent validation**: `store()` and `update()` share rules and custom error messages for name, email, and age.
*   **Server-side persistence**: `Student::create()` and `$student->update()` ensure data is safely stored via Eloquent.
*   **User feedback loop**: Successful create, update, and delete actions use session flash messages to keep the user informed.
*   **UI-focused experience**: The glassmorphic dashboard, confirmation modal, and responsive layout emphasize clarity and safety.

---

## 🛠️ Tech Stack

*   **Back-end**: PHP 8.2+ / Laravel 12 (MVC Architecture)
*   **Front-end**: HTML5 / Blade Templating Engine / JavaScript (ES6)
*   **Styling**: Tailwind CSS v4.0 (Modern utility-first architecture)
*   **Database**: MySQL / MariaDB (via Eloquent ORM & Migrations)
*   **Build Tool**: Vite 6+

---

## 🚀 Setup & Installation Instructions

Follow these step-by-step instructions to get the project running locally in your environment:

### Step 1: Clone or Open Project
Navigate to the root directory of the project:
```bash
cd StudentMS
```

### Step 2: Install PHP & Node Dependencies
Install the required Composer packages and NPM assets:
```bash
# Install backend dependencies
composer install

# Install frontend packages
npm install
```

### Step 3: Environment Configuration
1. Copy the `.env.example` file to create your active environment file:
   ```bash
   cp .env.example .env
   ```
2. Open the newly created `.env` file and modify the database connection credentials as outlined in the **Environment Configuration Checklist** below.

### Step 4: Generate Application Key
Generate the secure encryption key for the Laravel session handler:
```bash
php artisan key:generate
```

### Step 5: Run Migrations & Seed Sample Data
Execute migrations to build the tables in your database and seed it with initial mock students:
```bash
php artisan migrate --seed
```

### Step 6: Start Local Development Servers
To see the application live, open two terminal windows and run:
*   **Terminal 1 (Backend Server)**:
    ```bash
    php artisan serve
    ```
*   **Terminal 2 (Frontend Bundler)**:
    ```bash
    npm run dev
    ```

Once both servers are running, navigate to `http://127.0.0.1:8000` in your web browser. The root URL automatically redirects you to the Student Dashboard!

---

## 📋 Environment Configuration Checklist

Ensure the following variables in your `.env` file are properly filled to establish a connection to your local database server:

```env
DB_CONNECTION=mysql          # Your database driver (normally mysql)
DB_HOST=127.0.0.1            # Database server host address
DB_PORT=3307                 # Port number (default is 3306, set to your active port)
DB_DATABASE=student_db       # Name of the database you created on your MySQL server
DB_USERNAME=root             # Username for accessing your local database server
DB_PASSWORD=your_password    # Password associated with your database username
```

---

## 📂 File Architecture Highlight

Key implementation files created/modified for this midterm project:

*   **Database Schema Migration**: `database/migrations/2026_05_21_090444_create_students_table.php` (defines name, unique email, and age columns)
*   **Eloquent Model**: `app/Models/Student.php` (defines `$fillable` fields for mass-assignment security)
*   **Resourceful Controller**: `app/Http/Controllers/StudentController.php` (handles MVC logic, input validations, and redirect responses)
*   **Resourceful Routes**: `routes/web.php` (sets up resourceful bindings and root redirection)
*   **Views**:
    *   `resources/views/layouts/app.blade.php` (main application scaffold, navigation, styling tokens, flash alert components)
    *   `resources/views/students/index.blade.php` (dashboard table list, search filters, statistics grid, safety confirmation modal)
    *   `resources/views/students/create.blade.php` (form for adding students with error handlers)
    *   `resources/views/students/edit.blade.php` (form for updating existing student records)
*   **Database Seeder**: `database/seeders/DatabaseSeeder.php` (seeds initial mock students for visual testing)

---

## 🎓 Evaluation Criteria Met

*   **MVC Architecture (30%)**: Structured with complete separation between the database schema (`Student` model), rendering logic (`students.index`, `create`, `edit` Views), and execution actions (`StudentController`).
*   **Data Validation (15%)**: Strict field checks prevent duplicate email entries and non-integer/invalid age values, offering clean inline warnings.
*   **User Experience & UI (15%)**: Beautiful animations, clear indicators, automated popup dismissals, real-time query searching, and custom error displays guarantee a stunning first impression.
*   **Safety Actions (40%)**: Safe deletion processes verified via dynamic overlay confirmation panels before invoking standard SQL `DELETE` calls.
