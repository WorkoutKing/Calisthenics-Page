# Calisthenics Challenges Platform

Welcome to the **Calisthenics Challenges Platform**, a web application designed to promote fitness through exciting and engaging challenges. Users can join challenges, upload their results, and earn points while competing with others.

---

## Features

### For Authenticated Users:

-   **Join Active Challenges**: Browse and join currently active challenges.
-   **Upload Results**: Submit your results for approval and track your performance.
-   **View Progress**: See your status and whether your results are approved or pending.
-   **Admin Management**: Admins can create, edit, and delete challenges and manage their statuses.

### For Guests:

-   **Explore Challenges**: View active and previous challenges.
-   **Call to Action**: Encouraged to register or log in to participate and upload results.

---

## Built With

-   **Framework**: Laravel
-   **Frontend**: TailwindCSS for modern and responsive design
-   **Database**: MySQL (Eloquent ORM)
-   **Authentication**: Laravel Breeze
-   **Icons**: Font Awesome

---

## Installation and Setup

1. **Clone the Repository**

    ```bash
    git clone https://github.com/WorkoutKing/Calisthenics-Page.git
    cd calisthenics-challenges
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Set Up Environment**

    - Copy the `.env.example` file and rename it to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Configure the `.env` file with your database credentials and other settings.

4. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5. **Migrate and Seed the Database**

    ```bash
    php artisan migrate --seed
    ```

6. **Build Assets**

    ```bash
    npm run build
    ```

7. **Start the Server**
    ```bash
    php artisan serve
    ```

Visit the application at `http://localhost:8000`.

---

## Usage

1. **Register an Account**: Sign up to start participating in challenges.
2. **Join Challenges**: Explore active challenges and join the ones that interest you.
3. **Upload Results**: Submit your performance to earn points and track your progress.
4. **Admin Panel**: If you’re an admin, manage challenges and their statuses.

---

## Folder Structure

-   **`app/`**: Core application files (Controllers, Models, Middleware).
-   **`resources/views/`**: Blade templates for frontend pages.
-   **`routes/`**: Web routes defined in `web.php`.
-   **`public/`**: Publicly accessible assets (compiled CSS/JS).
-   **`database/`**: Migrations, seeders, and factories.

---

## Contribution Guidelines

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Commit changes and push to your branch.
4. Open a pull request to the main branch.

---

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.

---

## Contact

For questions, feedback, or support:

-   **Email**: madstars4ever@gmail.com
-   **GitHub**: https://github.com/WorkoutKing
