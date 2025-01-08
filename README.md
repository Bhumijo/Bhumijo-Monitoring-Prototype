# Quick Admin Panel System

Quick Admin Panel System is an open-source Laravel-based repository designed to help developers quickly set up a system admin panel. The initial version includes a backend API for facility usage monitoring, a frontend admin panel, and a preconfigured MySQL database. This project will eventually grow to include features such as user and role management, payment integration, and advanced monitoring capabilities.

---

## Features (Current and Planned)

### Backend
- **Facility Usage Monitoring API**: Tracks which users access which facilities and at what times (currently available).

### Planned Features
- **User and Role Management**: Pre-configured user authentication and authorization.
- **Payment Integration**: Placeholder module for integrating payment systems.
- **Monitoring and Analytics**: Base setup for monitoring resource usage.

### Frontend
- **Admin Panel**: User-friendly interface for managing the system (based on Figma prototype).

Figma Prototype Link: [Admin Panel Design](https://www.figma.com/proto/oKkZWuwpO3lCZvqFseihiT/Dashboard?node-id=0-1&t=gYc4crbnVVHiK8Qf-1)

---



## Tech Stack
- **Backend**: Laravel Framework (PHP)
- **Frontend**: React.js (or any modern JavaScript framework integrated with Laravel Mix)
- **Database**: MySQL

---

## Getting Started

### Installation

Instructions below explains how you can setup your local development environment.

**Prerequisite**

We assume following software is setup on your local, and updated to latest versions.

- [Rancher desktop](https://rancherdesktop.io/)
OR
[Docker desktop](https://www.docker.com/products/docker-desktop/)
- git
- composer


**1st time setup**

- Clone the repo
- `cd bhumijo-api-laravel`
- `cp .env.example .env` (fill out missing data)
- `composer install` or if composer is not locally installed then

    ```
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php80-composer:latest \
        composer install --ignore-platform-reqs
    ```
- `./vendor/bin/sail up -d`
- `./vendor/bin/sail exec app php artisan key:generate`
- `./vendor/bin/sail exec app php artisan migrate --seed`

**Everyday development**

- `./vendor/bin/sail up -d` to start servers
- `./vendor/bin/sail stop` to stop servers
- point browser to [`http://localhost:80`](http://localhost:80) to access the application.
- point browser to [`http://localhost:8025`](http://localhost:8025) to access mailhog dashboard (local email tester).
- mysql is hosted at `:3306` port, use this port in your mysql manager.
- point browser to [`http://localhost/api/documentation`](http://localhost/api/documentation) to access api documentation.

**Tips**

- `sail` is equivalent of `docker-compose` or `docker compose`, read [`laravel/sail`](https://laravel.com/docs/8.x/sail) doc

---

## Usage

1. **Facility Usage Monitoring API:**
   - Endpoint: `GET /api/admin/business-overview`
   - Returns: JSON data of facility usage.

   Example response:
   ```json
   [
     {
        "total_income": 150,
        "total_income_subscribed": 50,
        "total_income_anonymous": 100,
        "total_expense": 500,
        "total_profit": -350,
        "total_new_users": 150,
        "total_new_users_male": 50,
        "total_new_users_female": 100,
        "total_new_users_other": 100,
        "total_usages_male": 100,
        "total_usages_female": 100
    }
   ]
   ```

2. **Admin Panel:**
   - Log in with default admin credentials:
     - Email: `admin@example.com`
     - Password: `password`
   - Navigate through the user-friendly interface to manage facilities, users, and more.

---


## Monitoring Dashboard

We provide a pre-configured monitoring dashboard using Grafana for tracking environment metrics. Our IoT Quality Monitoring system detects live data via an ESP32 board, stores it in InfluxDB, and visualizes it in Grafana, all running on a Raspberry Pi.

### Dashboard Details
- **Environment Monitoring Dashboard**:
  - [Bhumijo Monitor Dashboard](https://dashboardoffice.bhumijomonitor.online/d/fe2po8f3koem8e/bhumijo-monitor-dashboard?orgId=1&from=now-6h&to=now&timezone=browser&refresh=5s)
  - **User ID**: `user.1`
  - **Password**: `Bhumijo@123`

---

## Contribution Guide

We welcome contributions to make this project better! Here's how you can contribute:

1. **Fork the Repository:**
   Click the "Fork" button on the repository page.

2. **Clone the Forked Repository:**
   ```bash
   git clone https://github.com/your-username/Bhumijo/Bhumijo-Monitoring-Prototype.git
   ```

3. **Create a Feature Branch:**
   ```bash
   git checkout -b feature/your-feature-name
   ```

4. **Make Changes:**
   - Ensure code quality and follow the coding standards.

5. **Test Your Changes:**
   ```bash
   php artisan test
   ```

6. **Commit and Push:**
   ```bash
   git add .
   git commit -m "Add your feature description"
   git push origin feature/your-feature-name
   ```

7. **Create a Pull Request:**
   Open a pull request from your branch to the `main` branch of this repository.

---

## License

This project is licensed under the [MIT LICENCE](http://opensource.org/licenses/MIT).

---
## Physical Visuability
Here is the physical useses video of Smart Access Control: https://www.facebook.com/reel/417529624570708
## Contact

For queries or feedback, please open an issue or contact the maintainer at info@bhumijo.com.

---

Thank you for using the **Laravel Admin Panel Boilerplate**! Happy coding!