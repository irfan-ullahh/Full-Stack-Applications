# Full Stack Applications

This repository contains multiple full-stack web applications developed using modern technologies like **Laravel**, **Livewire**, **React**, **Node.js**, etc.

## Projects

### 1. UET PayFlow
**Folder**: [`/uet-payflow`](./uet-payflow)

A secure and modern payment/flow management system built with **Laravel 11**, **Livewire 3**, and **Volt**.

#### Tech Stack
- Laravel 11
- Livewire + Volt
- Tailwind CSS + Vite
- MySQL

#### How to Run UET PayFlow

```bash
cd uet-payflow

# Install PHP dependencies
composer install

# Install frontend dependencies
npm install
npm run build

# Setup environment
copy .env.example .env
php artisan key:generate

# Database setup
php artisan migrate

# Start the server
php artisan serve
