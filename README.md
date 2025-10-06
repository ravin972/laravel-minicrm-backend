# MiniCRM

MiniCRM is a simple, powerful, and intuitive Customer Relationship Management system built with Laravel. It helps small businesses and freelancers manage their clients, projects, and tasks all in one place.

![LARAVELMINICRM-min](https://github.com/user-attachments/assets/43873f99-f69e-4c74-8b34-dc8fbf356aec)

## Features

- **Client Management**: Keep all your client information organized, accessible, and up-to-date in one central location
- **Project Tracking**: Monitor project progress, deadlines, and milestones from start to finish
- **Task Organization**: Create, assign, and track tasks for every project
- **Role-Based Access Control**: Secure permission system for Admins and Users
- **Dashboard Analytics**: Real-time overview of your business activities
- **Activity Logging**: Track all important changes and updates
- **Responsive Design**: Works seamlessly on desktop and mobile devices

## Tech Stack

- **Framework**: Laravel 12.x
- **PHP Version**: 8.2 or higher
- **Database**: MySQL/PostgreSQL
- **Frontend**: Blade Templates, TailwindCSS
- **Authentication**: Laravel Breeze
- **Authorization**: Spatie Laravel-permission
- **Development Tools**: Laravel Sail, Laravel Pint, PHPUnit

## Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or PostgreSQL
- Git

## Installation

1. Clone the repository:
```bash
git clone https://github.com/ravin972/laravel-minicrm-backend.git
cd laravel-minicrm-backend
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=minicrm
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations and seeders:
```bash
php artisan migrate --seed
```

8. Start the development server:
```bash
php artisan serve
```

9. In a separate terminal, compile assets:
```bash
npm run dev
```

## Default Admin Credentials

After running the seeders, you can login with these credentials:
- Email: admin@example.com
- Password: password

## Available Commands

- `composer dev`: Start development environment with concurrent server, queue listener, logs, and Vite
- `composer test`: Run the test suite
- `php artisan migrate:fresh --seed`: Reset and seed the database
- `npm run dev`: Start Vite development server
- `npm run build`: Build assets for production

## Project Structure

```plaintext
minicrm/
├── app/                 # Application core code
│   ├── Http/           # Controllers and Middleware
│   ├── Models/         # Eloquent models
│   └── Policies/       # Authorization policies
├── database/
│   ├── factories/      # Model factories
│   ├── migrations/     # Database migrations
│   └── seeders/       # Database seeders
├── resources/
│   ├── css/           # Stylesheets
│   ├── js/            # JavaScript files
│   └── views/         # Blade templates
└── routes/            # Application routes
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Deployment

The application can be deployed on any PHP hosting platform that meets the requirements. For Railway deployment:

1. Create a new project on Railway
2. Connect your GitHub repository
3. Add MySQL service
4. Configure environment variables
5. Deploy the application

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- [Laravel](https://laravel.com) - The web framework used
- [Tailwind CSS](https://tailwindcss.com) - For styling
- [Spatie Laravel-permission](https://github.com/spatie/laravel-permission) - For role-based permissions
