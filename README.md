# Documentation for BrightWeb E-Commerce Package

## Package Overview

The **BrightWeb E-Commerce** package is a complete e-commerce solution built with Laravel, Livewire, HTML, CSS, and JavaScript. It provides a full-featured frontend and backend for managing and selling products.

### Features:

- Automatic installation of Livewire.
- Simple table migration with `php artisan migrate`.
- Admin dashboard for managing categories, products, and orders.
- Support for product variations, pricing, discounts, and inventory management.
- Configurable payment gateways including PayPal, Paystack, and Pay on Delivery.
- Email notifications for order confirmations (both user and admin).
- Automatic cleanup of delivered orders after 7-9 days.
- Fully customizable frontend and backend settings.

---

## Installation Instructions

### Step 1: Install the Package

To install the package, use Composer:

```bash
composer require brightweb/ecommerce
```

### Step 2: Migrate the Database

Run the following command to create the necessary tables:

```bash
php artisan migrate
```

### Step 3: Start the Project

Start your Laravel development server with:
Remember to comment you defalut laravel home route for your site to use the packge home directory, to do this, navigate into routes/web.php 

```bash
// Route::get('/', function () {
//     return view('welcome');
// });
```



```bash
php artisan serve
```

### Step 4: Promote an Admin User

Manually promote an email to admin by editing the `users` table in the database:

1. Locate the user’s record.
2. Update the `role` field to `admin`.

After logging in as an admin, the Admin Dashboard will be accessible via the navigation bar.

---

## Features and Functionalities

### Product Management

Admins can:

- Add product categories.
- Add products with details such as:
  - Variations (e.g., size, color).
  - produts gallery.
  - Purchase price.
  - Selling price.
  - Quantity.
  - Discount.
  - coupon code.

### Order Management

- Users receive an email confirmation upon placing an order.
- Admins receive an email notification with order details.
- Admins can process orders via the Admin Dashboard.
- Users can track their orders in their dashboard.
- Delivered orders are automatically deleted from the system after 7-9 days.

### Payment Gateway Configuration

The package supports multiple payment methods:

- PayPal
- Paystack
- Pay on Delivery

Other payment methods like Stripe and Razorpay are placeholders for future implementation.

### Configuration Options

Run the following command to publish the configuration file:

```bash
php artisan vendor:publish --tag=brightwebconfig
```

The configuration file will be located at `config/brightwebconfig.php`.

#### Payment Settings

```php
'mypayment_options' => [
    'enable_stripe' => false, // Stripe not yet implemented
    'enable_razorpay' => false, // Razorpay not yet implemented
    'enable_paypal' => true, // To disable PayPal, set it to false
    'enable_paystack' => true, // To disable Paystack, set it to false
    'enable_pay_on_delivery' => true, // To disable Pay on Delivery, set it to false
],
```

#### Currency Settings

```php
'currency' => [
    'site_Currency' => '$',// here you an add your currency 
],
```

#### Frontend Category Settings

```php
'frontend_category_settings' => [
    'show_top_categories' => true, // Show top categories, to disable it set it to false
    'show_sidebar_category' => true, // Show sidebar categories, to disable it set it to false
],
```

#### Frontend Navigation Settings
- To setup the colors of your navigation
```php
'frontend_navigation_settings' => [
    'navigation_bg_color' => 'black', 
    'navigation_text_color' => 'white',
],
```

#### Frontend Site Settings

```php
'frontend_site_settings' => [
    'site_bg_color' => '#ffffff',
    'site_primary_color' => 'blue',
    'site_button_color' => 'white',
    'site_text_color' => 'gray',
],
```

#### Admin Site Settings

```php
'admin_site_settings' => [
    'site_bg_color' => '#ffffff',
    'site_primary_color' => 'blue',
    'site_button_color' => 'white',
    'gradient1' => 'rgb(131,58,180)',
    'gradient2' => 'linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%)',
    'counter_color' => 'white',
],
```

---

## Payment Gateway Setup

### PayPal

Add the following to your `.env` file:

```env
PAYPAL_CLIENT_ID=your_client_id
PAYPAL_CLIENT_SECRET=your_client_secret
```

### Paystack

Add the following to your `.env` file:

```env
PAYSTACK_SECRET_KEY=your_secret_key
PAYSTACK_PUBLIC_KEY=your_public_key
```

---

## Notes

1. For testing purposes, an admin user cannot purchase items.
2. To test as a user, do not promote the test email to admin.
3. Email notifications will be sent for order confirmations.
4. Regularly update your `.env` file with valid keys for payment gateways.

## Email Configuration: 
Set up email services in the .env file. For Gmail, you can use the following configuration for testing:

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls

The site will send an email to an admin using your MAIL_FROM_ADDRESS on .env

## SEO Features
The package includes SEO-friendly features to optimize your site for search engines. As an admin, you can configure:

Site Name
SEO Meta Tags (e.g., meta description, meta keywords)
Social Media Previews (e.g., Twitter Card settings)
Admin SEO Configuration Example:
Twitter Title
Meta Description
Keywords
These settings are available through the Admin Dashboard and can be adjusted in real-time.

## Troubleshooting

Issue: Admin Access Not Visible
Ensure you’ve set the correct role to admin in the database for the user account.
Issue: Payments Not Processing
Double-check the credentials in your .env file for PayPal and Paystack.

## Conclusion
The BrightWeb E-Commerce Package is an excellent tool for building scalable e-commerce sites with powerful admin and user features. Customize the frontend and backend settings to suit your needs, and easily manage orders, products, and payments.

Explore the Admin Dashboard for further customization and enhancements, and enjoy building your e-commerce site!
## Support

<!-- For support, please visit the [BrightWeb E-Commerce GitHub repository](#). -->

