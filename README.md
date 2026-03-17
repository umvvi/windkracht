# Windkracht-12 KiteSurfSchool Reservation System

A professional Laravel-based reservation system for a kitesurfing school, built with Tailwind CSS.

## Features

### Public Pages
- **Home**: Information about kitesurfing and the school
- **Packages**: Display of all available lesson packages
- **Locations**: List of all teaching locations
- **About**: School information and instructor details

### Customer Features
- Register and create account
- Edit personal information
- Make reservations for lessons
- View and manage reservations
- Cancel lessons with reason
- Mark payments as received
- View lesson schedule

### Instructor Features
- Register and create account
- Edit personal information and BSN
- View personal schedule (daily, weekly, monthly views)
- Manage assigned customers
- Cancel lessons (illness or bad weather)
- View customer information

### Owner/Admin Features
- Pre-registered account (terence@windkracht12.nl)
- View all customers and instructors
- Change user roles
- Manage reservations and payments
- Confirm payments and process bookings
- View unpaid reservations
- Block/unblock users
- View instructor schedules
- Send cancellation emails to customers

### Authentication
- Secure registration with password requirements:
  - Minimum 12 characters
  - At least 1 uppercase letter
  - At least 1 number
  - At least 1 special character (@, #, $, %, ^, &, *)
- Login/logout functionality
- Role-based access control (Customer, Instructor, Owner)
- Login/logout logging

## Tech Stack

- **Backend**: Laravel 10.x with PHP 8.1+
- **Frontend**: Blade templating engine
- **Styling**: Tailwind CSS
- **Database**: SQLite (development)
- **Build Tool**: Vite

## Project Structure

```
├── app/
│   ├── Models/              # Database models
│   ├── Http/
│   │   ├── Controllers/     # Route controllers
│   │   └── Middleware/      # Custom middleware
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Test data seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Tailwind styles
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php            # Web routes
└── config/                 # Configuration files
```

## Setup Instructions

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js and npm
- SQLite (or another database)

### Installation

1. **Install PHP Dependencies**
   ```bash
   composer install
   ```

2. **Install JavaScript Dependencies**
   ```bash
   npm install
   ```

3. **Build CSS (Tailwind)**
   ```bash
   npm run build
   ```
   Or for development with hot reload:
   ```bash
   npm run dev
   ```

4. **Create Database**
   Create an empty SQLite database:
   ```bash
   touch database/database.sqlite
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed Test Data**
   ```bash
   php artisan db:seed
   ```

### Running the Application

Start the development server:
```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`

## Test Accounts

After seeding the database, you can login with these accounts:

### Owner
- Email: `terence@windkracht12.nl`
- Password: `Owner@Password123`

### Instructors
- Email: `duco.veenstra@windkracht12.nl` (and others)
- Password: `Instructor@Password123`

### Customers
- Email: `customer1@example.com` through `customer10@example.com`
- Password: `Customer@Password123`

## Available Routes

### Public Routes
- `/` - Home page
- `/packages` - View packages
- `/locations` - View locations
- `/about` - About page
- `/register` - Registration
- `/login` - Login

### Customer Routes
- `/customer/dashboard` - Dashboard
- `/customer/personal-info` - Edit profile
- `/customer/make-reservation` - Make reservation
- `/customer/reservations` - View reservations

### Instructor Routes
- `/instructor/dashboard` - Dashboard
- `/instructor/personal-info` - Edit profile
- `/instructor/schedule` - View schedule
- `/instructor/customers` - View customers

### Owner Routes
- `/owner/dashboard` - Dashboard
- `/owner/customers` - Manage customers
- `/owner/instructors` - Manage instructors
- `/owner/reservations` - Manage reservations

## Database Schema

### Tables
- `users` - User accounts (customers, instructors, owner)
- `personal_information` - User profile information
- `locations` - Teaching locations
- `packages` - Lesson packages
- `reservations` - Customer reservations
- `lessons` - Individual lessons
- `duo_lesson_participants` - Participants in duo lessons
- `login_logs` - Login/logout activity logs

## API Structure

All main functionality is accessible through web forms and POST routes. The system currently uses traditional form submissions rather than JSON APIs. A REST API can be added in the future if needed.

## Security Features

- Password hashing with bcrypt
- CSRF protection on all forms
- Role-based access control
- Input validation and sanitization
- SQL injection prevention through Eloquent ORM
- Secure authentication middleware
- Login/logout activity logging

## Future Enhancements

- Email notifications for reservations
- Payment gateway integration
- Weather API integration for wind conditions
- SMS notifications
- REST API endpoints
- Admin dashboard with analytics
- Instructor assignment automation
- Student progress tracking
- Feedback/rating system

## License

MIT License

## Support

For issues or questions about this project, please contact Terence Olieslager.
