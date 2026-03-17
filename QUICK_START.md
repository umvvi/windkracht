# Quick Start Guide - Windkracht-12 KiteSurfSchool

## ⚡ First Time Setup (5 minutes)

### Step 1: Install Dependencies
```bash
# Install PHP packages
composer install

# Install Node packages
npm install
```

### Step 2: Generate Application Key
```bash
php artisan key:generate
```

### Step 3: Create Database
```bash
# Create SQLite database file
touch database/database.sqlite
```

### Step 4: Run Migrations & Seed Data
```bash
# Create all tables
php artisan migrate

# Populate with test data
php artisan db:seed
```

### Step 5: Build Frontend Assets
```bash
# Production build
npm run build

# Or development with watch (in separate terminal)
npm run dev
```

### Step 6: Start Development Server
```bash
php artisan serve
```

Visit http://localhost:8000 in your browser!

---

## 🔑 Test Login Credentials

### Owner Dashboard (Full Access)
- **Email**: `terence@windkracht12.nl`
- **Password**: `Owner@Password123`
- **URL**: http://localhost:8000/owner/dashboard

### Instructor Dashboard
- **Email**: `duco.veenstra@windkracht12.nl`
- **Password**: `Instructor@Password123`
- **URL**: http://localhost:8000/instructor/dashboard

### Customer Dashboard  
- **Email**: `customer1@example.com`
- **Password**: `Customer@Password123`
- **URL**: http://localhost:8000/customer/dashboard

---

## 📋 Features Walkthrough

### For Customers
1. Register or login
2. Complete personal profile
3. Browse packages and locations
4. Make a reservation
5. Receive invoice via email
6. Mark payment as received
7. View scheduled lessons

### For Instructors
1. Login with credentials
2. Complete personal profile
3. View schedule (day/week/month)
4. Manage assigned customers
5. Cancel lessons with reason
6. View customer information

### For Owner
1. Pre-registered account
2. View all customers and instructors
3. Confirm payments
4. Change user roles
5. Block/unblock users
6. Monitor reservations and payments

---

## 🛠️ Common Commands

```bash
# Create new migration
php artisan make:migration create_table_name --create=table_name

# Create new model
php artisan make:model ModelName

# Create new controller
php artisan make:controller ControllerName

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Refresh database with seed data
php artisan migrate:fresh --seed

# Tinker (interactive shell)
php artisan tinker

# Clear cache
php artisan cache:clear
```

---

## 📁 Project Structure

```
school/
├── app/
│   ├── Models/              # Database models (User, Lesson, etc.)
│   ├── Http/
│   │   ├── Controllers/     # Route handlers (Auth, Dashboard, etc.)
│   │   └── Middleware/      # Access control (CheckRole)
├── database/
│   ├── migrations/          # Table definitions
│   ├── seeders/            # Test data
│   └── database.sqlite     # Data file (created)
├── resources/
│   ├── views/              # HTML templates (Blade)
│   ├── css/                # Tailwind CSS
│   └── js/                 # JavaScript
├── routes/
│   ├── web.php            # All web routes
│   └── console.php        # CLI commands
├── public/
│   └── index.php          # Entry point
├── .env                    # Configuration
├── composer.json          # PHP dependencies
├── package.json           # Node dependencies
├── vite.config.js         # Build configuration
└── README.md              # Full documentation
```

---

## 🐛 Troubleshooting

### "Class not found" error
```bash
composer dump-autoload
```

### CSS not compiling
```bash
npm run dev
# In another terminal:
php artisan serve
```

### Database not found
```bash
touch database/database.sqlite
php artisan migrate
```

### Port 8000 already in use
```bash
php artisan serve --port=8001
```

### Clear everything and start fresh
```bash
php artisan migrate:fresh --seed
```

---

## 📚 Important Files to Review

1. **routes/web.php** - All URL routes defined here
2. **app/Http/Controllers/** - Business logic for each feature
3. **app/Models/** - Database table definitions
4. **resources/views/** - HTML templates
5. **database/migrations/** - Table schemas
6. **database/seeders/DatabaseSeeder.php** - Test data

---

## 🔒 Security Notes

- All passwords are hashed with bcrypt
- CSRF tokens on all forms
- Role-based access control
- Login/logout activity logged
- SQLite database (for demo - use PostgreSQL/MySQL in production)

---

## 📞 Next Steps

1. Customize branding in `resources/views/layouts/app.blade.php`
2. Add more test locations via the seeder
3. Configure email in `.env` for real notifications
4. Set up payment gateway integration
5. Deploy to production server

---

Happy coding! 🏄‍♀️
