# Heylies Studio Management System

A powerful, Laravel-based application designed to streamline and automate daily operations in creative studios. From user and client management to workflow automation and secure payment tracking, Heylies Studio Management System is your complete studio solution.

---

## 🚀 Features

### 🔐 User Management
- Role-based access control (Admin, Photographer, Editor, etc.)
- Secure authentication (Laravel Breeze or Jetstream)
- Custom dashboards per role
- Activity logs and audit trails

### 🔄 Workflow Automation
- Automated task assignment
- Project status tracking (e.g., Booked → In Progress → Delivered)
- Notification system (Email/SMS for reminders, updates)
- Trigger-based workflows (e.g., send invoice after completion)

### 💳 Payment Management
- Invoice generation and tracking
- Multiple payment gateways (Stripe, PayPal)
- Client payment portal
- Reminders for pending payments
- Payment reports

### 📅 Booking System
- Interactive calendar with conflict-free scheduling
- Sync with Google Calendar (optional)
- Booking history and status tracking

### 📁 Project & Media Management
- Media file uploads and versioning
- Secure sharing via client-specific download links
- Delivery tracking

### 📊 Reporting & Insights
- Revenue, booking, and productivity analytics
- Exportable reports (CSV, PDF)
- Visual dashboards for key metrics

---

## ⚙️ Tech Stack

- **Framework:** Laravel 10+
- **Frontend:** Blade + Bootstrap / Tailwind CSS
- **Database:** MySQL / PostgreSQL
- **Authentication:** Laravel Breeze or Jetstream
- **File Storage:** Laravel Filesystem (supports AWS S3, local, etc.)
- **Notifications:** Laravel Notifications (Email & SMS)
- **Payments:** Stripe, PayPal (Laravel Cashier or direct API)

---

## 🛠️ Installation

### Prerequisites
- PHP 8.1+
- Composer
- MySQL / PostgreSQL
- Node.js & npm
- Laravel CLI (`composer global require laravel/installer`)

### Setup Steps

```bash
# Clone the repository
git clone https://github.com/yourusername/cafepixel.git
cd cafepixel

# Install PHP dependencies
composer install

# Install Node.js dependencies and build assets
npm install
npm run dev

# Copy and configure environment variables
cp .env.example .env
php artisan key:generate

# Set up the database (run migrations and seeders)
php artisan migrate --seed

# (Optional) Link storage for media files
php artisan storage:link

# Start the Laravel development server
php artisan serve
