# GAME-CONSIGN-ASSESSMENT-TEST-BACKEND-DEVELOPER

## Requirements

- PHP >= 8.1
- Laravel >= 10.x
- Composer
- Git

## Installation

1. Clone the repository
```bash
git clone https://github.com/aghnilazuardy/GAME-CONSIGN-ASSESSMENT-TEST.git
```

2. Navigate to project directory
```bash
cd assessment-test-backend-developer
```

3. Install dependencies
```bash
composer install
```

4. Copy the environment file
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

## Project Structure

```
app/
├── Services/
│   └── AnagramService.php      # Main service for anagram grouping
├── Http/
│   └── Controllers/
│       └── AnagramController.php # Controller handling anagram endpoints
```

## Usage

### As an API Endpoint

1. Add the route to your `routes/api.php`:
```php
use App\Http\Controllers\AnagramController;

Route::post('/group-anagrams', [AnagramController::class, 'groupAnagrams']);
```

2. Send a POST request to `/api/anagrams`

Example Request:
```json
[
    "kita",
    "atik",
    "tika",
    "suka",
    "aku",
    "kia",
    "kaus",
    "makan",
    "kua"
]
```

Example Response:
```json
[
    [
        "atik",
        "kita",
        "tika"
    ],
    [
        "aku",
        "kua"
    ],
    [
        "kaus",
        "suka"
    ],
    [
        "kia"
    ],
    [
        "makan"
    ]
]
```

## Running Tests

The project includes unit tests for the AnagramService. To run the tests:

```bash
php artisan test
```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Support

For support, please open an issue in the GitHub repository or contact the maintainers.