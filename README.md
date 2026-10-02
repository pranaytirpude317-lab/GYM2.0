# IRONFORGE — PHP + MySQL

This version keeps the original HTML/CSS/JavaScript gym design and adds a PHP backend with MySQL.

## Added
- `index.php` — website page.
- `config.php` — PDO MySQL connection.
- `submit_contact.php` — validates and stores contact requests.
- `database.sql` — creates the database and table.
- `script.js` — sends the form to PHP with `fetch()`.
- Membership selection is stored with each request.

## Run with XAMPP
1. Install XAMPP and start Apache + MySQL.
2. Put this folder in `C:\xampp\htdocs\`.
3. Open `http://localhost/phpmyadmin`.
4. Import `database.sql`.
5. If your MySQL login differs, edit `config.php`.
6. Open `http://localhost/ironforge_php/index.php`.

Do not double-click `index.php`; PHP needs Apache/PHP to execute.

Keep your existing `images/` folder and image files inside this project.
