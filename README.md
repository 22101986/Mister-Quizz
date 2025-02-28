# Mister Quiz - Quiz Game Website

## Project Overview
Mister Quiz is a web-based quiz game inspired by the popular game show "Who Wants to Be a Millionaire?". The project is built using **PHP** with the **Laravel** framework, one of the most popular and powerful PHP web frameworks. This project challenges developers to complete the remaining features of the quiz game by following the instructions and requirements outlined below.

## Features
### User Authentication
- User Registration: Username, Email, Password, and Password Confirmation.
- User Login: Email and Password.
- Error messages for invalid login credentials.
- Navigation between Login and Registration pages.

### User Profile
- Username and Email display.
- XP amount based on correct answers.
- Rank system based on XP:
  - Quiz Apprentice: < 1500 XP
  - Average Quizer: 1500 - 5000 XP
  - Epic Quizer: 5000 - 10000 XP
  - Quiz Master: >= 10000 XP
- Score statistics for each question category:
  - Percentage of correct answers
  - Number of correct answers
  - Total questions answered
- Profile visibility restricted to the owner.

### Quiz System
- Start Quiz Button (only accessible to logged-in users).
- Questions displayed with multiple-choice answers.
- Categories available:
  - Art
  - History
  - Geography
  - Science
  - Sports
- XP awarded for each correct answer.
- Results Page showing:
  - Number of correct answers vs total questions
  - Breakdown of correct answers by category
- Persistent quiz session (same questions on page refresh or restart).
- Submission only allowed when all questions are answered.

### Leaderboard
- Top 10 players ranked by XP.
- Displays:
  - Username
  - XP amount
  - Total correct answers

## Technologies Used
- PHP
- Laravel
- MySQL
- Blade Templating Engine
- XAMPP

## Folder Structure
- `app/Http/Controllers/` - Backend logic controllers
- `app/Models/` - Data models
- `database/migrations/` - Database migrations
- `public/` - CSS, JS, and images
- `resources/views/` - Blade templates
- `routes/web.php` - Website routes

## Commands Cheatsheet
| Command                  | Description                     |
|--------------------------|---------------------------------|
| `php artisan make:controller` | Create a new controller        |
| `php artisan make:model`      | Create a new model            |
| `php artisan migrate`         | Apply migrations              |
| `php artisan db:seed`         | Seed the database             |
| `php artisan serve`           | Start the development server   |

## License
This project is for educational purposes only.

## Contribution
Feel free to fork this repository and submit pull requests to enhance the project.

