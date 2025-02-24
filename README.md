# Video Game Management System API

## Assignment Title
Building a "Simple Video Game Management System API"

## Description
This "Laravel application" provides the backend for a "video game management system". It supplies an "API" for the frontend to "create", "edit", and "retrieve" video game data. The API also includes "user authentication", "validation", and "role-based access control".

## Features & Requirements

1. **User Authentication**  
   - Users can "register", "log in", and "log out"  
   - Uses "Laravel's built-in authentication system" (optionally with "Laravel Sanctum" for token-based API calls)

2. **Game Management**  
   - Authenticated users can "add", "edit", "delete", and "view" video games  
   - Each game has: "title", "description", "release date", "genre"

3. **Game Listing / Dashboard**  
   - A "dashboard page" for logged-in users lists their video games  
   - Users can "filter games by genre" and "sort them by release date"

4. **Validation**  
   - Forms for creating and editing games use "Laravel's validation" to ensure proper data entry  
   - Errors are displayed gracefully (e.g., in "Blade templates" or as "JSON responses")

5. **Database Integration**  
   - Uses "Laravel's Eloquent ORM"  
   - Database schema includes "users" and "video_games" tables

6. **User Roles**  
   - Two roles: "Admin" and "Regular User"  
   - Only "admins" can delete video games created by other users; "regular users" can only delete their own games

7. **Bonus (Optional)**  
   - Add a "rating/review feature" for video games  
   - Use "Docker containers" for the Laravel app and/or the database

## Technologies & Versions
- PHP: "8.1"  
- Composer: "2.6"  
- Laravel: "10.2"  
- Database: Your choice ("MySQL", "PostgreSQL", "SQLite", etc.)

## Project Structure Overview
```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── "AuthController.php"
│   │       ├── "DashboardController.php"
│   │       ├── "ReviewController.php"
│   │       ├── "UserAuthController.php"
│   │       ├── "VideoGameController.php"
│   │       └── "GameController.php"
│   └── Models/
│       ├── "User.php"
│       ├── "Review.php"
│       └── "VideoGame.php"
├── database/
│   └── migrations/
│       ├── "create_users_table.php"
│       ├── "create_reviews_table.php"
│       └── "create_video_games_table.php"
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── "login.blade.php"
│       │   └── "register.blade.php"
│       ├── games/
│       │   ├── "create.blade.php"
│       │   └── "edit.blade.php"
│       ├── layout/
│       │   └── "app.blade.php"
│       ├── reviews /
│       │   └── "create.blade.php"
│       └── "dashboard.blade.php"
├── routes/
│   └── "web.php"
├── ".env"
├── "composer.json"
├── "README.md"
└── ...
```

## Installation & Setup

1. **Clone the Repository**
   ```bash
   git clone "https://github.com/AmpasTheodoros/videogame-api.git"
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   ```bash
   cp ".env.example" ".env"
   ```
   Update the .env file with your database credentials:
   ```env
   DB_CONNECTION="mysql"
   DB_HOST="127.0.0.1"
   DB_PORT="3306"
   DB_DATABASE="videogame_db"
   DB_USERNAME="root"
   DB_PASSWORD=""
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Serve the Application**
   ```bash
   php artisan serve
   ```
   The app is now accessible at "http://127.0.0.1:8000"

## Usage

### Web Interface
- Register: Visit "/register" to create a new account
- Login: Visit "/login" to log in
- Dashboard: After logging in, you'll be redirected to "/dashboard"
- Add a Game: Visit "/games/create" to add a new game
- Edit a Game: Visit "/games/{id}/edit" (only if you're the owner)
- Delete a Game: "Admins" can delete any game; "regular users" can only delete their own
- Add a Review: Visit `/games/{videoGameId}/reviews/create` to submit a rating and comment (if using a Blade form).  
- View Reviews: Visit `/games/{videoGameId}/reviews` (API or Blade approach) to see all reviews for a specific game.

### API Endpoints (Optional with Sanctum)

| Method | Endpoint                                 | Description                                          | Auth Required |
|--------|------------------------------------------|------------------------------------------------------|---------------|
| POST   | /login                                   | User login (returns API token)                       | No            |
| POST   | /register                                | User registration                                    | No            |
| POST   | /logout                                  | Logout (invalidates token)                           | Yes           |
| GET    | /games                                   | List games                                           | Yes           |
| POST   | /games                                   | Create a new game                                    | Yes           |
| GET    | /games/{id}                              | Show game details                                    | Yes           |
| PUT    | /games/{id}                              | Update a game (only if you're the owner)             | Yes           |
| DELETE | /games/{id}                              | Delete a game (owner or admin)                       | Yes           |
| GET    | /games/{videoGameId}/reviews             | List all reviews for a specific game                 | Yes           |
| POST   | /games/{videoGameId}/reviews             | Create a new review for a specific game              | Yes           |
| GET    | /games/{videoGameId}/reviews/create      | Show a form to create a new review (Blade approach)  | Yes           |


## Validation
- Controllers use "Laravel's validation" in "store()" and "update()" to ensure:
  - "title", "description", "release_date", "genre" are required
  - "release_date" must be a valid date
  - Validation errors are displayed to users (via "Blade templates" or "JSON")

## User Roles
- "users" table includes a "role" column: "admin" or "user"
- "Admin" can delete any user's game; "regular users" can only delete their own
- Role checks are enforced in controllers (e.g., "destroy()" method)

## Contributing
1. Fork this repository
2. Create a "feature branch"
3. Commit your changes
4. Submit a "Pull Request"

## License
This project is open-sourced software licensed under the "MIT license"

---

### Requirements Satisfied ✅
- "User Authentication" (register, login, logout)
- "CRUD" on games (title, description, release_date, genre)
- "Dashboard" (filter + sort)
- "Validation" (form validation, error handling)
- "Database Integration" (Eloquent ORM, users + video_games tables)
- "User Roles" (admin vs. regular user; admin can delete others' games)
- "Bonus" (optional ratings/reviews, Docker support)

### Postman Collection Documentation

You can import the following details into Postman to test and document the API endpoints for the Video Game Management System.

#### 1. User Registration
- **Method:** POST  
- **Endpoint:** `/register`  
- **Body (JSON):**
```json
{
  "username": "exampleuser",
  "password": "password123"
}
```
## Success Response (200):
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOi...",
  "token_type": "Bearer"
}
```

#### 2. User Login
- **Method:** POST  
- **Endpoint:** `/login`  
- **Body (JSON):**
```json
{
  "username": "exampleuser",
  "password": "password123"
}
```
## Success Response (200):
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOi...",
  "token_type": "Bearer"
}
```

#### 3. Logout
- **Method:** POST  
- **Endpoint:** `/logout`  
- **Headers: Authorization: Bearer {token}**
## Success Response (200):
```json
{
  "message": "Logged out successfully"
}
```

#### 4. List Video Games
- **Method:** GET  
- **Endpoint:** `/games`  
- **Headers: Authorization: Bearer {token}**
## Success Response (200):
```json
[
  {
    "id": 1,
    "user_id": 1,
    "title": "Game Title",
    "description": "Game Description",
    "release_date": "2023-01-01",
    "genre": "Action",
    "created_at": "2023-05-01T12:00:00Z",
    "updated_at": "2023-05-01T12:00:00Z"
  },
]
```

#### 5. Create a New Game
- **Method:** POST  
- **Endpoint:** `/games`  
- **Headers: Authorization: Bearer {token}**
- **Body (JSON):**
```json
{
  "title": "New Game",
  "description": "New game description",
  "release_date": "2023-05-01",
  "genre": "Adventure"
}

```
## Success Response (200):
```json
{
  "id": 2,
  "user_id": 1,
  "title": "New Game",
  "description": "New game description",
  "release_date": "2023-05-01",
  "genre": "Adventure",
  "created_at": "2023-05-02T10:00:00Z",
  "updated_at": "2023-05-02T10:00:00Z"
}
```

#### 6. Update a Game
- **Method:** PUT  
- **Endpoint:** `/games/{id}`  
- **Headers: Authorization: Bearer {token}**
- **Body (JSON):**
```json
{
  "title": "Updated Game Title",
  "description": "Updated description",
  "release_date": "2023-05-15",
  "genre": "Action-Adventure"
}
```
## Success Response (200):
```json
{
  "id": 2,
  "user_id": 1,
  "title": "Updated Game Title",
  "description": "Updated description",
  "release_date": "2023-05-15",
  "genre": "Action-Adventure",
  "created_at": "2023-05-02T10:00:00Z",
  "updated_at": "2023-05-02T11:00:00Z"
}
```

#### 7. Delete a Game
- **Method:** DELETE  
- **Endpoint:** `/games/{id}`  
- **Headers: Authorization: Bearer {token}**
## Success Response (200):
```json
{
  "message": "Game deleted successfully"
}
```

#### 8. List Reviews for a Game
- **Method:** GET  
- **Endpoint:** `/games/{videoGameId}/reviews`  
- **Headers: Authorization: Bearer {token}**
## Success Response (200):
```json
[
  {
    "id": 1,
    "user_id": 1,
    "video_game_id": 2,
    "rating": 5,
    "comment": "Amazing game!",
    "created_at": "2023-05-03T14:00:00Z",
    "updated_at": "2023-05-03T14:00:00Z",
    "user": {
      "id": 1,
      "username": "exampleuser"
    }
  },
]
```

#### 9. Create a Review for a Game
- **Method:** POST  
- **Endpoint:** `/games/{videoGameId}/reviews`  
- **Headers: Authorization: Bearer {token}**
- **Body (JSON):**
```json
{
  "rating": 4,
  "comment": "Really enjoyed playing this game!"
}
```
## Success Response (200):
```json
{
  "id": 2,
  "user_id": 1,
  "video_game_id": 2,
  "rating": 4,
  "comment": "Really enjoyed playing this game!",
  "created_at": "2023-05-03T15:00:00Z",
  "updated_at": "2023-05-03T15:00:00Z"
}
```