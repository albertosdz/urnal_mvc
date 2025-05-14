# Urnal

## Description

Urnal is a PHP-based web application project developed as a Final Degree Project (TFG). This application utilizes a custom MVC architecture with modern frontend tooling to deliver a responsive and user-friendly experience.

## Project Structure

```
Urnal/
├── controllers/       # Controller classes for handling requests
├── models/           # Data models and database interaction
├── views/            # View templates and presentation logic
├── includes/         # Helper classes and utility functions
├── public/           # Publicly accessible files (CSS, JS, images)
├── src/              # Source files for frontend assets
├── vendor/           # Composer dependencies
├── node_modules/     # Node.js dependencies
├── Router.php        # Custom routing implementation
├── composer.json     # PHP dependency management
├── package.json      # Node.js dependency management
└── gulpfile.js       # Task automation for frontend build
```

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP 7.4 or higher
- [Composer](https://getcomposer.org/) for PHP dependency management
- [Node.js](https://nodejs.org/) (14.x or later recommended) and npm
- Web server (Apache/Nginx) with PHP support
- MySQL or similar database system

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/albertosdz/urnal_mvc.git
   cd Urnal
   ```

2. Install PHP dependencies via Composer:
   ```bash
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

4. Build frontend assets:
   ```bash
   npm run build
   ```
   
   Or using Gulp directly:
   ```bash
   gulp
   ```

5. Configure your web server to point to the `public` directory as the document root.

6. Create a database and configure the connection details in the appropriate configuration file.

## Usage

1. Start your web server and ensure PHP is running.

2. For development with automatic asset compilation, run:
   ```bash
   npm run dev
   ```

3. Access the application through your web browser at the configured URL (typically http://localhost or a virtual host you've set up).

## Development

For frontend development with automatic rebuilding:
```bash
gulp watch
```

## License

[Specify your license information here]

## Author

Developed by [Your Name] as a Final Degree Project (TFG) for [Your Institution].

