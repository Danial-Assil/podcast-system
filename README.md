
# Podcast System

## Description

A platform for users to create podcast channels, upload episodes, and interact through nested comments.

---

## Features

- Users can create their own podcast channels linked to their accounts.
- Upload podcast episodes with cover images.
- Comment system with support for nested replies (threaded discussions).
- Custom Exception Handling for better error management.
- API-based architecture (Laravel).

---

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Danial-Assil/podcast-system.git
   ```

2. Navigate to the project directory:

   ```bash
   cd podcast-system
   ```

3. Install dependencies:

   ```bash
   composer install
   npm install
   ```

4. Copy `.env.example` to `.env` and set your environment variables:

   ```bash
   cp .env.example .env
   ```

5. Generate application key:

   ```bash
   php artisan key:generate
   ```

6. Set your database and mail configuration in the `.env` file.

7. Run migrations:

   ```bash
   php artisan migrate
   ```

---

## Usage

- Create an account and your own podcast channel.
- Upload podcast episodes and cover images.
- View and participate in threaded comment discussions.
- All actions available via RESTful API.

---

## Technologies Used

- Laravel 12
- PHP 8+
- MySQL / PostgreSQL
- Mailtrap or SMTP for email features
- Composer & NPM

---

## License

MIT License

---

## Author

Danial-Assil
