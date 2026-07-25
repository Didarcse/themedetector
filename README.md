# ThemeDetectorTool v2

> Theme detection and analysis platform built on Kernel Framework v1.

**Author:** Didar Alam  
**Company:** Global Kernel  
**Framework:** Kernel Framework v1  
**PHP:** 8.2+

---

## Requirements

- PHP 8.2 or higher
- Composer 2.x
- Apache/Nginx with mod_rewrite enabled (or PHP built-in server for development)

## Installation

```bash
# Clone the repository
git clone https://github.com/globalkernel/themedetector-tool.git
cd themedetector-tool

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php -r "echo bin2hex(random_bytes(32));"
# Paste the output into APP_KEY in .env
```

## Development

```bash
# Start the built-in PHP server
php -S localhost:8000 -t public/

# Run tests
composer test

# Run static analysis
composer analyse

# Check code style
composer cs-check

# Fix code style
composer cs-fix
```

## Folder Structure

```
themedetector/
├── app/                    # Application layer (Services, Controllers, Models, etc.)
├── bootstrap/              # Application bootstrap and initialization
├── config/                 # Configuration files
├── core/                   # Kernel Framework core
├── database/               # Migrations, seeders
├── public/                 # Web root (document root)
│   └── index.php           # Entry point
├── resources/
│   ├── assets/             # Frontend assets (CSS, JS, images)
│   └── views/              # View templates
├── routes/                 # Route definitions
├── storage/
│   ├── cache/              # Application cache
│   ├── logs/               # Application logs
│   └── uploads/            # User uploads
├── tests/                  # Automated tests
├── .env.example            # Environment template
├── .gitignore              # Git ignore rules
├── composer.json           # Composer configuration
├── LICENSE                 # License file
└── README.md               # This file
```

## License

Proprietary - Global Kernel. All rights reserved.
