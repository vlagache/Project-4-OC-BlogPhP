# How to start the project

for the future me in 10 years.🏋️‍♂️


## XAMPP

Download [XAMPP](https://www.apachefriends.org/fr/index.html)

In the download folder

```
chmod 755 xampp-linux-*-installer.run
./xampp-linux-*-installer.run
```

Start XAMPP

```
/opt/lampp/lampp start
```

## Phpmyadmin

You can normally access PhpMyadmin by going to `localhost/phpmyadmin`

Create a database with the name of your choice and the following tables: : 

```sql
CREATE TABLE chapters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    edit_date DATETIME,
    trash_chapter TINYINT(1) DEFAULT 0,
    name_thumbnail VARCHAR(255)
);
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT NOT NULL,
    author VARCHAR(255) NOT NULL,
    comment TEXT NOT NULL,
    comment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    report_com TINYINT(1) DEFAULT 0,
    hidden_com TINYINT(1) DEFAULT 0,
    hidden_by VARCHAR(255),
    hidden_date DATETIME,
    FOREIGN KEY (chapter_id) REFERENCES chapters(id) ON DELETE CASCADE
);
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

In the `config.ini` file at the root of the project, complete the information required to connect to your database.

```ini
dbname = ""
dblogin = ""
dbpassword = ""
```


## Add an admin 

In a `password.php` file at the root of the project

```php
<?php
$password = 'your admin password';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
?>
```
Copy the hashed password you obtain by going to `localhost/password.php` and create an admin in the admin table with this password.

You will be able to connect to the site administration interface


### Read/write permission for /assets/images/thumbnails folder

Remember to give the necessary write and read permissions to the assets/images/thumbnails folder, which stores chapter thumbnails.

### Site access

Depending on the folder in which the site files are stored, modify the value of `$folder` in `config.php`.

Example: if it's in `/opt/lampp/htdocs/p4`, `$folder = '/p4'`.

**Go to localhost/p4 ✌️**

