# Laravel Users Management System
A back-end application which will have User Entity: email / password, Role Entity: Administrator and User.

## Features

### User Management

- Users can register and reset their passwords via email.
- Users need to confirm their email addresses.

### Profile Management

- Users can edit their profiles, including FIRST_NAME, LAST_NAME, and AVATAR.
- User avatars are stored on a public S3 compatible storage.

### Administration

- Administrators can delete users.
- Users can be promoted to administrators.

### State Management

- The application is stateless, with session information stored in REDIS.

### Logging

- Application logs are printed to STDOUT.

### Code Style

- The project adheres to a specified code style standard.

### Debugging

- Development mode allows step-by-step debugging using XDebug.

### Docker and Kubernetes

- The application is deployable as a standalone Docker image (PHP+WebServer) for Kubernetes deployment.

### Technologies Uesd:
- PHP Laravel
- MySql
- Minio
- Maildev
- Docker
- Redis

## How to run on local (Development)

This guide will walk you through the steps to set up and run a this application on your local

### Prerequisites

Before you begin, make sure you have the following tools installed on your system:

- Docker: [Install Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Install Docker Compose](https://docs.docker.com/compose/install/)

### Step 1: Clone the Repository

```bash
git clone https://github.com/ashokhirpara1/laravel-users-management
cd laravel-users-management
```

Start the Docker containers: `./vendor/bin/sail up`
Build vite and watch any frontend changes: `./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev`
Run migrations: `./vendor/bin/sail php artisan migrate`
Run database seeder to create roles: `./vendor/bin/sail php artisan db:seed --class=RolesTableSeeder`

1. Access the application in your web browser: `http://localhost/`
2. Maildev mail server will be accessible from: `http://0.0.0.0:1080/`
3. Minio console dashboard is accessible from: `http://localhost:8900`

Stop the Docker contrainers: `./vendor/bin/sail down`



