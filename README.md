
# 📒 Notes App (PHP CRUD Application)

A simple **Notes Management Web Application** built using **PHP, MySQL, Bootstrap, JavaScript, and DataTables**.
This project demonstrates complete **CRUD operations** with a clean UI and proper user interaction.

---

## 🚀 Features

* ➕ Add new notes
* ✏️ Edit existing notes using a modal
* ❌ Delete notes with confirmation
* 📋 View all notes in a searchable & paginated table
* 🔔 Success notifications for Add / Edit / Delete actions

---

## 🛠️ Technologies Used

* **PHP** – Backend logic & server-side processing
* **MySQL** – Database to store notes
* **Bootstrap 4** – Responsive UI & modal
* **JavaScript** – Client-side interaction
* **jQuery & DataTables** – Table sorting, searching, pagination
* **XAMPP** – Local development environment

---

## 🗄️ Database Structure

**Database name:** `notes`

**Table name:** `notes`

| Column      | Type                              |
| ----------- | --------------------------------- |
| sno         | INT (Primary Key, Auto Increment) |
| title       | VARCHAR                           |
| description | TEXT                              |
| tstamp      | TIMESTAMP                         |

---

## ⚙️ How It Works (CRUD Flow)

* **Create** → User submits the “Add Note” form → data inserted into MySQL
* **Read** → Notes fetched using `SELECT` query and displayed in DataTable
* **Update** → Clicking Edit opens modal → data updated using `UPDATE` query
* **Delete** → Clicking Delete shows confirmation → record deleted using `DELETE` query

---

## 🧠 Key Concepts Implemented

* MySQL database connection using `mysqli_connect()`
* Form handling with `POST` and `GET` methods
* Conditional logic to separate **Insert / Update / Delete**
* Bootstrap modal for editing without page reload
* JavaScript DOM manipulation
* Session-based success notifications
* Basic CRUD application architecture

---

## 📌 Future Improvements

* Use Prepared Statements for security
* Add user authentication
* Add validation & error handling
* Improve UI/UX
* Convert to MVC structure

---



