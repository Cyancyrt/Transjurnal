<div align="center">

<img
src="docs/screenshots/logo.png"
width="220"
alt="ScholarBridge Logo">

# ScholarBridge

Connecting Researchers with Verified Academic Scholars

</div>

<img
    src="https://img.shields.io/badge/Laravel-11-red"
    alt="Laravel">

<img
    src="https://img.shields.io/badge/PHP-8.2-blue"
    alt="PHP">

<img
    src="https://img.shields.io/badge/TailwindCSS-3.x-cyan"
    alt="Tailwind">

</p>

<br>

<p align="center">

<img
    src="docs/screenshots/dashboard.png"
    width="90%"
    alt="Dashboard">

</p>
# ScholarBridge

ScholarBridge is a web-based academic journal translation marketplace that connects researchers with verified scholars and translators.

The platform allows users to submit journal translation requests, discover qualified scholars, negotiate translation opportunities, and monitor project progress through a centralized system.

---

## Features

### User Features

- Create journal translation requests
- Upload journal documents
- Browse available scholars
- Send translation requests to scholars
- Track order progress
- Download translated files
- Manage personal orders

### Scholar Features

- Create professional scholar profiles
- Define expertise and academic background
- Receive translation requests
- Accept or reject projects
- Upload translated documents
- Manage assigned orders

### Admin Features

- Dashboard analytics
- User management
- Scholar management
- Verification management
- Service management
- Marketplace reports
- Order monitoring

---

## System Architecture

### Roles

#### Administrator

Responsible for:

- Platform management
- Scholar verification
- Marketplace monitoring
- Analytics and reporting

#### User

Responsible for:

- Creating translation requests
- Selecting scholars
- Managing orders

#### Scholar

Responsible for:

- Translating journals
- Managing requests
- Completing projects

---

## Marketplace Workflow

### Step 1

User creates a translation order.

```text
User
 ↓
Create Order
```

### Step 2

System categorizes the order based on academic field.

```text
Computer Science
Medicine
Engineering
Economics
Education
```

### Step 3

Relevant scholars receive the opportunity.

```text
Order
 ↓
Scholar Marketplace
```

### Step 4

Scholar accepts the request.

```text
Scholar
 ↓
Accept Order
```

### Step 5

Order becomes active.

```text
open
 ↓
in_progress
```

### Step 6

Translation is uploaded.

```text
Scholar
 ↓
Upload Result
```

### Step 7

User reviews the result.

```text
completed
or
revision
```

---

## Order Status

| Status      | Description            |
| ----------- | ---------------------- |
| open        | Waiting for scholar    |
| in_progress | Being translated       |
| revision    | Revision requested     |
| completed   | Successfully completed |
| cancelled   | Cancelled              |

---

## Database Overview

### Users

```text
id
name
email
password
role
```

### Translator Profiles

```text
user_id
academic_title
university
expertise
languages
publication_count
hourly_rate
verification_status
bio
```

### Services

```text
name
description
base_price
```

### Orders

```text
user_id
translator_id
service_id

field
title
description

source_language
target_language

journal_file
translated_file

price
status
```

### Translator Requests

```text
order_id
translator_id
status
```

---

## Technology Stack

### Backend

- Laravel 11
- PHP 8.2+
- MySQL

### Frontend

- Blade
- TailwindCSS
- Bootstrap Icons

### Development Tools

- Composer
- Laravel Artisan

---

## Installation

Clone repository:

```bash
git clone https://github.com/yourusername/scholarbridge.git
```

Move into project:

```bash
cd scholarbridge
```

Install dependencies:

```bash
composer install
```

Copy environment:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database inside:

```env
DB_DATABASE=scholarbridge
DB_USERNAME=root
DB_PASSWORD=
```

Run migration:

```bash
php artisan migrate:fresh --seed
```

Start server:

```bash
php artisan serve
```

---

## Seeder Accounts

### Administrator

```text
Email:
admin@scholarbridge.test

Password:
password
```

### Scholars

```text
translator0@scholarbridge.test
translator1@scholarbridge.test
...
translator7@scholarbridge.test

Password:
password
```

### Users

```text
user1@scholarbridge.test
user2@scholarbridge.test
...
user20@scholarbridge.test

Password:
password
```

---

## Reports Module

The platform provides analytics for:

- Revenue tracking
- Service performance
- Scholar performance
- User activity
- Customer behavior
- Order status distribution

---

## Future Development

Planned improvements:

- Real-time notifications
- Payment gateway integration
- Scholar rating system
- Chat system
- Recommendation engine
- AI-assisted translation support

---

## License

This project was developed for academic purposes and final-year research projects.
