# 🩸 Blood Bridge — Smart Blood Donor & Request System

> Connecting blood donors with patients in urgent need — built to save lives.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)

---

## 📌 Overview

**Blood Bridge** is a full-stack web application designed to eliminate the gap between blood donors and patients in critical need. The platform provides a complete ecosystem — from donor registration and emergency alerts to admin-controlled approvals and real-time notifications — all within a clean, responsive interface.

---

## ✨ Key Features

| Feature | Description |
|--------|-------------|
| 🔐 Multi-Role Auth | Separate secure dashboards for Admin, Donor, and Requester |
| 🚨 Emergency Alerts | Donors with matching blood group are instantly notified |
| 🩸 Blood Inventory | Admin tracks and manages blood units by group |
| 🔔 Notifications | Real-time role-based alerts across all user types |
| 💬 Bilingual Chatbot | Floating widget — responds in both Urdu and English |
| 🛡️ Security | SQL injection prevention and session-based access control |
| 📱 Responsive UI | Red-and-white medical theme, works on all screen sizes |

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML5, CSS3, JavaScript |
| Backend | PHP (Procedural) |
| Database | MySQL |
| Server | XAMPP / Apache |
| Icons | Font Awesome 6 |

---

## 👥 User Roles & Access

### 🔴 Admin
- Approve or reject blood requests
- View and confirm matched donors
- Manage blood inventory
- Read contact messages and notifications

### 🟡 Donor
- Receive emergency alerts based on blood group match
- Accept or decline emergency requests
- Track donation history and availability status

### 🟢 Requester
- Submit standard and emergency blood requests
- Track request status in real time
- Receive donor match notifications from admin

---

## 🚨 Emergency Request Flow

```
Requester submits emergency form
            ↓
Matching donor receives alert on dashboard
            ↓
Donor accepts → Admin notified
            ↓
Admin confirms donor → Requester notified with donor details
            ↓
Request marked Approved ✅
```

---

## 💬 Bilingual Chatbot

A floating chatbot widget on the homepage that:
- Auto-detects **Urdu or English** based on user input
- Answers common queries — donation, registration, emergency, blood groups, contact
- Built with **pure JavaScript** — no third-party API required
- Accessible via a floating button on the bottom-right corner

---

## 🔐 Security Implementation

- Session-based authentication with role verification on every page
- `intval()` applied on all `$_GET` parameters to prevent SQL injection
- Input sanitization across all user-facing forms
- Unauthorized URL access redirects to login page

---

## 📁 Project Structure

```
blood-bridge/
├── index.php                  # Homepage
├── login.php                  # Login page
├── register.php               # Registration page
├── admin_dashboard.php        # Admin panel
├── donor_dashboard.php        # Donor panel
├── requester_dashboard.php    # Requester panel
├── emergency_request.php      # Emergency blood request form
├── contact.php                # Contact page
├── style.css                  # Main stylesheet
└── Images/                    # Project images
```

---

## 📄 License

This project was developed for academic purposes at QUEST University.
