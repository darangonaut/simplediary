# SimDiary

SimDiary is a simple diary application built with Laravel and Tailwind CSS.

## Features

- User registration and authentication
- Create, edit, and delete diary entries
- View diary entries by date
- Search diary entries by keyword

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/simdiary.git
    ```

2. Install the dependencies:

    ```bash
    composer install
    npm install
    ```

3. Copy the `.env.example` file to `.env` and update the database configuration:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Run the database migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

5. Start the development server:

    ```bash
    php artisan serve
    ```

6. Visit `http://localhost:8000` in your web browser to access the application.

## Usage

1. Register a new user account or log in with an existing account.
2. Click on the "New Entry" button to create a new diary entry.
3. Fill in the date, title, and content of the diary entry.
4. Click on the "Save" button to save the entry.
5. Use the search bar to search for specific keywords in your diary entries.
6. Click on the "Edit" button to edit an existing diary entry.
7. Click on the "Delete" button to delete a diary entry.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvement, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).
