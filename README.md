# 🎓 Simple Student Management System (StudentMS)

# Proponents
    Mark Joero Flores
    Kevin Cancino
    Mary Ann Parana
    Aice Ruetas
    Lawrence Collado

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

## Design Blueprint

The interface is a glassmorphic admin dashboard built for fast scanning, safe actions, and a premium feel. It uses layered panels, soft glows, and high-contrast typography to keep data readable while maintaining a modern aesthetic.

### Layout Map (Dashboard)

```
+------------------------------------------------------------------+
| StudentMS                          [Search: Name/Email] [Add New] |
+------------------------------------------------------------------+
| [Total Students]   [Average Age]   [Min Age]   [Max Age]          |
+------------------------------------------------------------------+
| Table: Name | Email | Age | Actions (Edit / Delete)              |
| ...                                                              |
+------------------------------------------------------------------+
| Flash Alerts (top-right, auto-dismiss)                           |
+------------------------------------------------------------------+
```

### Key UI Elements

*   **Header Row**: App title on the left, search input centered, primary CTA on the right.
*   **Stats Grid**: Three or four compact glass panels with large numbers and small labels.
*   **Data Table**: High-contrast rows with subtle hover glow; actions grouped per row.
*   **Delete Modal**: Centered frosted panel with a warning accent and clear confirm/cancel buttons.
*   **Flash Alerts**: Stacked toasts in the top-right, slide-in with short lifetime.

### Visual Tokens

*   **Background Gradient**: #0b1022 -> #0f172a -> #1e1b4b
*   **Panel Surface**: rgba(15, 23, 42, 0.6) with 12px backdrop blur
*   **Accent Colors**: Indigo #6366f1 for primary, Cyan #22d3ee for highlights
*   **Border**: 1px rgba(148, 163, 184, 0.2)
*   **Shadow**: 0 20px 40px -20px rgba(0, 0, 0, 0.6)
*   **Typography**: Headings in Outfit, body in Manrope
*   **Radius / Spacing**: 12px corner radius, 24px layout grid

### Responsive Behavior

*   Collapse header into stacked rows under 768px.
*   Stack stats cards into a single column on small screens.
*   Switch table to a card list layout for narrow widths.

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
