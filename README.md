# 🍽️ Le Goût du Délice

A restaurant management web app: customers scan the **QR code on their table**, browse the menu and order without leaving their seat. The order reaches the front desk, which passes it on to the kitchen.

> ⚠️ Work in progress. See [Project status](#project-status) for what already works.

![Laravel](https://img.shields.io/badge/Laravel-12-red) ![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue) ![Tailwind](https://img.shields.io/badge/Tailwind-CSS-38bdf8) ![Status](https://img.shields.io/badge/status-in%20development-orange)

## 🎬 Demo

- **Live demo:** _to be added_
- **Screenshots:** _to be added in `docs/screenshots/`_ (landing page, manager dashboard, dish management, table QR codes)

## 💡 Goal

A restaurant in Benin where every table has its own QR code:

1. The customer scans the QR code and opens the menu for their table.
2. They order from their seat, without calling a waiter.
3. The front desk receives the order and sends it to the kitchen.
4. The manager follows the activity from a dashboard.

Planned: remote ordering (from home, work or anywhere in town) with delivery, table reservation in advance, a newsletter, and Mobile Money payment.

## ✅ Project status

| Feature | Status |
|---|---|
| Public landing page | ✅ Done |
| Newsletter subscription / unsubscribe link | ✅ Done |
| Authentication with roles (manager, waitress, kitchen) | ✅ Done |
| Manager dashboard: today's orders, sales, orders in progress | ✅ Done |
| Category management (create, edit, enable/disable, delete) | ✅ Done |
| Dish management (CRUD, multiple images, main image, enable/disable) | ✅ Done |
| Table management and QR code generation (SVG) | ✅ Done |
| Front desk (waitress) and kitchen screens | 🟡 Order display only |
| Full database schema (orders, payments, deliveries, delivery staff, newsletters) | ✅ Done |
| Customer menu page opened through the QR code | 🚧 In progress |
| Customer ordering | 🚧 To do |
| Mobile Money payment (MTN, Moov, Celtiis) | 🚧 To do |
| Delivery and delivery staff tracking | 🚧 To do |
| Table reservation | 🚧 To do |
| Sending newsletters | 🚧 To do |
| Real-time kitchen/front desk notifications (Laravel Reverb) | 🚧 Configured, not wired yet |

## 🧰 Tech stack

- **Backend:** Laravel 12, PHP 8.2+
- **Database:** SQLite by default (MySQL supported)
- **Frontend:** Blade, Tailwind CSS, Alpine.js, Vite
- **Authentication:** Laravel Breeze
- **QR codes:** simplesoftwareio/simple-qrcode
- **PDF:** barryvdh/laravel-dompdf
- **Real time:** Laravel Reverb (prepared)

## 🚀 Getting started

Requirements: PHP 8.2+, Composer, Node.js and npm.

```bash
git clone https://github.com/MichelgalaxyOne/gout-du-delice.git
cd gout-du-delice

composer install
npm install

cp .env.example .env
php artisan key:generate

# SQLite database (default in .env.example)
touch database/database.sqlite
php artisan migrate --seed

# Makes the generated QR codes reachable from the browser
php artisan storage:link

# In two terminals
php artisan serve
npm run dev
```

The app is then available at http://127.0.0.1:8000.

## 🔑 Demo accounts

Created by `php artisan migrate --seed`:

| Role | Email | Password |
|---|---|---|
| Manager | gerant@delice.com | gerant123 |
| Waitress | serveuse@delice.com | password |
| Kitchen | cuisine@delice.com | password |

> These accounts are for demonstration only. Never keep them in production.

The seeder also creates 25 tables, 4 categories (Starters, Mains, Drinks, Desserts) and a few sample dishes.

## 🗂️ Project structure

```
app/Http/Controllers/   Manager, Waitress, Kitchen, Landing, Newsletter
app/Http/Middleware/    Role-based access control
app/Models/             Plat, Categorie, Commande, RestoTable, Paiement, Livraison…
database/migrations/    Database schema
database/seeders/       Demo data
resources/views/        gerant/, serveuse/, cuisine/, landing, newsletter/
routes/web.php          Routes per role (/gerant, /serveuse, /cuisine)
```

## 🗺️ Roadmap

1. Customer menu page reachable through the QR code
2. Cart and order placement
3. Mobile Money payment (MTN, Moov, Celtiis) and cash payment
4. Real-time notifications for the kitchen and front desk
5. Online ordering with delivery
6. Table reservation in advance
7. Newsletter sending (promotions, new menu, news)

## 🔒 Security

- The `.env` file is never committed: use `.env.example` as a template.
- Change all demo passwords before any real deployment.
- Set `APP_DEBUG=false` in production.

## 👤 Author

**Marie-Michel HOUNKPE**: [GitHub @MichelgalaxyOne](https://github.com/MichelgalaxyOne)

## 📄 License

Released under the MIT license (add a `LICENSE` file to confirm).
