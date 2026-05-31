# Hospitality (Management System)
### Web Systems and Technologies — Final Project A.Y. 2025-2026

> Inspired by [kishan0725/Hospital-Management-System](https://github.com/kishan0725/Hospital-Management-System)  
> Rebuilt using HTML + CSS + JavaScript + PHP + MySQL

---

## What This Project Does

This is a web-based Hospital Management System with **CRUD functionality** for the **Appointments module**:

| Operation | What it does | File |
|---|---|---|
| Create | Book a new appointment | `appointments/create.php` |
| Read | View all appointments in a table | `appointments/index.php` |
| Update | Edit an existing appointment | `appointments/edit.php` |
| Delete | Remove an appointment (with confirmation) | `appointments/delete.php` |

Doctors and Patients are read-only (view only).

---

## Technology Stack

| Layer | Technology | Why we chose it |
|---|---|---|
| Frontend | HTML5 | Taught in class (Topic 4) |
| Styling | CSS3 | Taught in class (Topic 5) — no Bootstrap needed |
| Interactivity | JavaScript (Vanilla) | Taught in class (Topic 6) |
| Backend | PHP (basic, mysqli) | Simple and runs on XAMPP with no setup |
| Database | MySQL | Works with PHP out of the box |
| Local Server | XAMPP | Standard for academic PHP projects |

---

## Folder Structure

```
hospital/
├── database.sql          ← Import this in phpMyAdmin first
└── src/
    ├── index.php         ← Dashboard (start here)
    ├── css/
    │   └── style.css     ← All CSS styles (no Bootstrap)
    ├── js/
    │   └── main.js       ← JavaScript (search, delete confirm, validation)
    ├── includes/
    │   ├── db.php        ← Database connection
    │   ├── header.php    ← Shared navigation bar
    │   └── footer.php    ← Shared footer + delete confirmation popup
    ├── appointments/
    │   ├── index.php     ← READ: list all appointments
    │   ├── create.php    ← CREATE: book new appointment
    │   ├── edit.php      ← UPDATE: edit existing appointment
    │   └── delete.php    ← DELETE: remove appointment
    ├── doctors/
    │   └── index.php     ← READ: list all doctors
    └── patients/
        └── index.php     ← READ: list all patients
```

---

## Installation Instructions

### Step 1 — Download and Install XAMPP

1. Go to [https://www.apachefriends.org](https://www.apachefriends.org)
2. Download and install XAMPP
3. Open the **XAMPP Control Panel**
4. Click **Start** next to **Apache**
5. Click **Start** next to **MySQL**

Both must show a green status, indicating that it is wworking or running.

---

### Step 2 — Copy the Project Files

Copy the entire `hospital` folder into your XAMPP web root:

```
Windows:  C:\xampp\htdocs\hospital\
Mac:      /Applications/XAMPP/htdocs/hospital/
```

Your final path should look like:
```
C:\xampp\htdocs\hospital\src\index.php
C:\xampp\htdocs\hospital\database.sql
```

---

### Step 3 — Create the Database

1. Open your browser and go to:
   ```
   http://localhost/phpmyadmin
   ```

2. Click **New** in the left sidebar

3. Type `hospital` as the database name → click **Create**

4. Click the **Import** tab at the top (You can also copy the codes from any editor, like VSCode and create the database `hospital` then once the database was created, go to SQL tab then paste the database.sql code)

5. Click **Choose File** → select `database.sql` from the hospital folder

6. Click **Go** at the bottom

You should see a success message. The tables `doctb`, `patreg`, `appointmenttb`, and `specialtb` will now exist.

---

### Step 4 — Check the Database Connection

Open the file:
```
C:\xampp\htdocs\hospital\src\includes\db.php
```

Make sure to check this settings and should match your MySQL setup:
```php
$host     = "localhost";  // usually localhost
$user     = "root";       // default XAMPP username
$password = "";           // default XAMPP password is empty
$database = "hospital";   // must match what you created in phpMyAdmin
```

---

### Step 5 — Open the Application

Open your browser and type:
```
http://localhost/hospital/src/
```

You should see the **Dashboard** with counts for Doctors, Patients, and Appointments.

---

## How to Use the System

### Viewing Records
- Click **Doctors** in the navigation to see all doctors
- Click **Patients** in the navigation to see all patients
- Click **Appointments** to see all appointments

### Searching
- On any list page, type in the search box to filter results instantly
- This uses JavaScript to hide/show rows without reloading the page

### Adding a New Appointment
1. Go to **Appointments**
2. Click **+ New Appointment**
3. Fill in the form: select a patient, a doctor, date, time, and status
4. Click **Save Appointment**

### Editing an Appointment
1. Go to **Appointments**
2. Click the **Edit** button on any row
3. Update the fields you want to change
4. Click **Save Changes**

### Deleting an Appointment
1. Go to **Appointments**
2. Click the **Delete** button on any row
3. A confirmation popup will appear — click **Yes, Delete** to confirm
4. Click **Cancel** to go back without deleting

---

## Troubleshooting

| Problem | Fix |
|---|---|
| "Cannot connect to database" | Make sure MySQL is running in XAMPP Control Panel |
| "No database selected" | Check that `$database = "hospital"` in db.php matches phpMyAdmin |
| Blank white page | Enable PHP error display: in XAMPP, edit `php.ini` and set `display_errors = On` |
| 404 Not Found | Make sure the folder is inside `C:\xampp\htdocs\` and Apache is running |
| Table not found | Re-import `database.sql` in phpMyAdmin |

---

## SQL Commands Reference

| Command | What it does | Used in |
|---|---|---|
| `SELECT * FROM table` | Get all rows | Read pages |
| `SELECT COUNT(*) FROM table` | Count rows | Dashboard |
| `INSERT INTO table VALUES (...)` | Add a new row | Create |
| `UPDATE table SET ... WHERE id=?` | Change a row | Edit |
| `DELETE FROM table WHERE id=?` | Remove a row | Delete |
| `LEFT JOIN` | Combine rows from two tables | Appointments list |

---

## References

- Original project: [kishan0725/Hospital-Management-System](https://github.com/kishan0725/Hospital-Management-System)
- Topic 4 (HTML), Topic 5 (CSS), Topic 6 (JavaScript) — IT 112 Web Systems and Technologies course materials posted in Google Classroom.
