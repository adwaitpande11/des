# DES (Daily Expense Software)
This is a personal expense management software designed to work on mobile browser. You can enter your daily expenses and earnings and see multiple reports.

## Description
This is my personal expense management application. Expenses, earnings and credits can be managed. It can produce reports such as - Category Wise Report, Day Wise Report, Last 4 Months Expense Report, Full Excel Download among few others. Extras screen is used to manage categories, contacts (used for Credits module) and password.

## Getting Started
I assume that you already have PHP, Apache server and MySQL installed.

1. Run the SQL editor and import the file `database/adw_des_oltp.sql`
1. Open `includes/connection.inc.php` and configure your database connection and environment details
1. If you can run .sh files, execute `composer-install.sh`, this installs composer locally (resulting into `composer.phar` file) for your project. If you cannot run .sh files, sorry for now, please take help from internet
1. Install dependencies using composer `php composer.phar install`
1. Make your server up and application should load properly

> Default username an password (as can be seen from `adw_user` table) is - admin | pass

## Troubleshooting
For additional help, `NOTES.md` may be useful
