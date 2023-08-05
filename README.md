# Loan Management System

The Loan Management System is a web application that allows users to manage loans and associated documents.

## Features

- Create, view, update, and delete loans
- Upload and manage loan documents
- Calculate loan installments based on loan type, amount, and duration

## Installation

1. Clone the repository:
```bash
   git clone https://github.com/wanafiqhaikal/loan-management-system.git
```

2. Install dependencies:
```bash
   cd loan-management-system
   composer install
   npm install
```


3. Create a `.env` file by duplicating `.env.example` and configuring your database settings:
```bash
   cp .env.example .env
   php artisan key:generate
```

4. Run the database migrations:
```bash
   php artisan migrate
```

5. Start the development server:
```bash
   php artisan serve
```

6. Access the application in your web browser at `http://localhost:8000`.


## Importing the Database

If you want to use the pre-populated database with sample data, follow these steps to import it:

1. Make sure you have MySQL installed on your system.

2. Download the SQL database dump file from the `database` directory of this repository. The file is named 
`loan_management_system.sql`.

3. Open your MySQL client (e.g., MySQL Workbench, phpMyAdmin, or the MySQL command-line tool).

4. Create a new database for the loan management system (if you haven't already):
```sql
   CREATE DATABASE loan_management_system;
```

5. Import the database dump into the newly created database. If you're using the MySQL command-line tool, 
you can use the following command:
```bash
   mysql -u your_username -p loan_management_system < loan_management_system.sql
```



