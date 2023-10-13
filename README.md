# Product Management System with Barcode Integration

Welcome to the Product Management System, a versatile CRUD application designed to help you efficiently manage your product catalog. This application seamlessly integrates barcode generation, multi-delete functionality, and PDF report generation for your convenience.

## Features

- **Create, Read, Update, Delete**: Perform CRUD operations on your product catalog with ease. Add new products, view existing entries, update product details, and remove outdated records.

- **Barcode Integration**: Automatically generate barcode images for each product, making it easier to track and identify products.

- **Multi-Delete**: Save time by selecting and deleting multiple product entries simultaneously.

- **Fresh Migrations**: Maintain a clean and structured database. Use the `/run-fresh-migrations` route to reset your tables, ensuring a fresh start for your product management.

- **Generate PDF Reports**: Create detailed PDF reports containing a table of product information, including product images with their respective barcodes.

## Getting Started

### Prerequisites

Before you begin, ensure you have the following prerequisites installed:

- PHP
- Composer
- Laravel (you can use Laravel's built-in development server for quick setup)

### Installation

1. **Clone the Repository**:

   ```shell
   git clone https://github.com/your/repo.git
    ```

2. **Run the following command to install the project's dependencies using Composer:**

   ```
   composer install 
   ```

3. **Configure Environment:**  Copy the .env.example file and rename it to .env. Update the database settings within the .env file to match your configuration.

4. **Generate Application Key:**

    ```
    php artisan key:generate
    ```

5. ~~ to got domainName.extension/run-fresh-migrations **
