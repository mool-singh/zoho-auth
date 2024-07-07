# Project Title

CodeIgniter 3 Zoho Books Integration

## Overview

This project demonstrates the integration of Zoho Books with a CodeIgniter 3 application. The application allows an admin to log in, generate Zoho refresh and access tokens, and sync invoices from Zoho Books to the local database.

## Demo

```
https://mool-singh.in/zoho-auth
```

## Features

- Admin login system
- Generate and manage Zoho refresh and access tokens
- Sync invoices from Zoho Books to local database
- List invoices in the application

## Prerequisites

- PHP >= 7.2
- MySQL
- Composer

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/yourusername/zoho-auth.git
   cd zoho-auth
   ```

2. **Import the Database**

   Import the attached `database.sql` file into your MySQL database.

3. **Install Dependencies**

   Run the following command to install the required dependencies:

   ```bash
   composer install
   ```

4. **Update Configuration**

   Update the constants in `application/config/constants.php` with your database credentials and Zoho Books API details:

   ```php
   // Database Credentials
   define('DB_HOST', 'your_db_host');
   define('DB_USER', 'your_db_user');
   define('DB_PASS', 'your_db_password');
   define('DB_NAME', 'your_db_name');

   // Zoho Books API Credentials
    define('ZOHO_ORG_ID','__your_value__');
    define('ZOHO_CLIENT_ID','__your_value__');
    define('ZOHO_CLIENT_SECRET','');
   ```

5. **Create a Zoho Server App**

   Create a Zoho server application and add the correct redirect URL from ZOHO_REDIRECT_URI constants in the Zoho Developer Console and update client and secret id in constant files

6. **Create a New Connection in Zoho Books**

   In Zoho Books, create a new connection with invoices permission. 

7. **Update the Base URL**

   If necessary, update the base URL in `application/config/config.php`:

   ```php
   $config['base_url'] = 'http://yourdomain.com/';
   ```

## Usage

1. **Run the Project**

   Start your local server and navigate to the project directory. Open your browser and visit the base URL to access the application.

2. **Admin Login**

   Use the admin credentials to log in to the application.

3. **Generate Zoho Tokens**

   Navigate to the token management section to generate and manage Zoho refresh and access tokens.

4. **Sync Invoices**

   Use the sync functionality to fetch invoices from Zoho Books and save them to the local database.

## Contributing

If you wish to contribute to this project, please create a fork, make your changes, and submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

For any queries or support, please contact:

- Mool Singh
- [mool30699@gmail.com](mailto:mool30699@gmail.com)

---

Feel free to customize this README file as per your project's requirements.