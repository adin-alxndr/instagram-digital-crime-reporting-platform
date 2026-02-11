# 🚨 Instagram Digital Crime Reporting Platform

A web-based platform for reporting and managing digital crime cases on **Instagram** securely and systematically.

This application allows users to submit crime reports along with personal data and supporting evidence. Each report will generate a unique tracking code. Administrators can manage victim data, case records, evidence, and process actions step by step until generating a final report in PDF format.

---

## 📌 Features

### 👤 User
- Submit digital crime reports  
- Input personal data and case description  
- Upload supporting evidence (screenshots/files)  
- Receive unique report code after submission  
- Track report status using report code  

### 🛡️ Admin
- Manage victim data (create, update, delete)  
- Manage case data  
- Manage evidence records  
- Process case handling in stages  
- Generate final investigation report in PDF  

---

## 🛠️ Tech Stack

- Backend: (Laravel / Django)  
- Frontend: HTML, CSS, JavaScript  
- Database: MySQL  
- File Upload & PDF Generator  

---

## ⚙️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/adin-alxndr/instagram-digital-crime-reporting-platform
cd instagram-digital-crime-reporting-platform
```
### 2. Install Dependencies
```bash
composer install
```
### 3. Environment Configuration
```bash
cp .env.example .env
```
Edit .env file according to your database configuration.

---

## 🗃️ Database Migration

Run migration to create database tables:
```bash
php artisan migrate
```

---

## ▶️ Run the Server
```bash
php artisan serve
```
Then open your browser:
```bash
http://127.0.0.1:8000/
```

---

## 📜 License

This project is developed for educational and portfolio purposes.