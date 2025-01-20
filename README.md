# Simple Laravel 8 API Authentication with JWT

This is a Simple Laravel 8 API Authentication with JWT with endpoints accessible via RESTful API.

## Features
- View all user (GET `/api/user`)
- Create new user (POST `/api/register`)
- Login user (POST `/api/login`)

## Requirements
- PHP 7.4 or higher
- Composer
- Laravel 8
- MySQL or MariaDB

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/adjisdhani/simple-api-lara8-auth-jwt.git
   ```

2. **Navigate to the project directory**:
   ```bash
   cd simple-api-lara8-auth-jwt
   ```

3. **Install dependencies**:
   ```bash
   composer install
   ```

4. **Generate the application key**:
   ```bash
    php artisan key:generate
    ```
5. **Configure the .env file**:
   ```bash
    DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=simple_api_crud_lara8
	DB_USERNAME=root
	DB_PASSWORD=yourpassword
   ```

6. **Start the development server**:
   ```bash
    php artisan serve
    ```

7. **Access the API**:
   (http://127.0.0.1:8000/)

      ## API Endpoints 
    
    **1. Get All Data**

    - Method: GET
    - Endpoint: /api/user
    - Description: Retrieve a list of all user.

    **Example Response**:
    
         [
            {
			    "id": 1,
			    "name": "John Doe",
			    "email": "john@example.com",
			    "email_verified_at": null,
			    "token_version": 11,
			    "created_at": "2025-01-20T04:28:15.000000Z",
			    "updated_at": "2025-01-20T07:05:47.000000Z"
			}
         ]

    **2. Create new user**
    
    - Method: POST
    - Endpoint: /api/register
    - <b>Body Parameters:</b>
      1. name (string, required)
      2. email (string, required)
      3. password (string, required)

    **Example Request**:
    
        [
    	    {
			    "name": "John Doe",
			    "email": "john@example.com",
			    "password": "password123"
			}
    	]

    **Example Response**:

       [
    	    {
			    "user": {
			        "name": "John Doe",
			        "email": "john@example.com",
			        "updated_at": "2025-01-20T04:28:15.000000Z",
			        "created_at": "2025-01-20T04:28:15.000000Z",
			        "id": 1
			    },
			    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTczNzM0NzI5NSwiZXhwIjoxNzM3MzUwODk1LCJuYmYiOjE3MzczNDcyOTUsImp0aSI6IlZ6WTlhQlFrcFZrV3RmeWMiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.o7FMoTlfZopqxoaSXbGbEchZoHZk6lwmj406HssSX_M"
			}
    	]

    **3. Login user**
    
    - Method: POST
    - Endpoint: /api/login
    - <b>Body Parameters:</b>
      1. name (string, required)
      2. email (string, required)
      3. password (string, required)

    **Example Request**:
    
       [
    	    {
			    "email": "john@example.com",
			    "password": "password123"
			}
    	]
    **Example Response**:

       [
    	    {
			    "user": {
			        "id": 1,
			        "name": "John Doe",
			        "email": "john@example.com",
			        "email_verified_at": null,
			        "token_version": 11,
			        "created_at": "2025-01-20T04:28:15.000000Z",
			        "updated_at": "2025-01-20T07:05:47.000000Z"
			    },
			    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTczNzM1Njc0NywiZXhwIjoxNzM3MzYwMzQ3LCJuYmYiOjE3MzczNTY3NDcsImp0aSI6IkllMGVpdjc2NjZ4WFd1ZjMiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJ0b2tlbl92ZXJzaW9uIjoxMX0.FHrqKdioC9dbg9XnoyuSQI0qNRl72PQ1aMatJESxYxs"
			}
    	]

8. **Penjelasan soal auth JWT nya**

   **1. Jika ingin menginstall dari awal komponen JWT nya , yang perlu dijalankan setelah install laravelnya adalah**
     ```bash
      	composer require tymon/jwt-auth
     ```

    **2. setelah itu jalankan CLI ini**
    ```bash
      	php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    ```

    **3. dan jalankan ini untuk sebagai secretnya**

    ```bash
       php artisan jwt:secret
    ```

    **4. setelah semua komponen selesai, kita harus membuat api yang harus lewat middlewarenya dulu di file api.php**

    ```bash
       Route::group(['middleware' => ['adjisganteng']], function () {
		    Route::get('user', [AuthController::class, 'user']);
		});
    ```

    **5. 'adjisganteng' harus didaftarkan dulu di file Kernel.php nya beserta file middlewarenya yang custom**

    ```bash
    	protected $routeMiddleware = [
	        'adjisganteng' => \App\Http\Middleware\JwtMiddleware::class,
	    ];
    ```

    **6. setelah itu buat file middlewarenya , bisa cek di JwtMiddleware.php**

    ```bash
    	protected $routeMiddleware = [
	        'adjisganteng' => \App\Http\Middleware\JwtMiddleware::class,
	    ];
    ```

    **7. penjelasan cara kerja JWTnya, yang pertama user harus register dulu**
    **8. ketika register ataupun user login akan mendapatkan token**
    **9. tokennya itu harus disisipkan di header pas mau hit endpoint untuk get all usernya**

    ```bash
    	Authorization (keynya): Bearer <new_token> (valuenya)
    ```
    **10. selesai API dengan JWT siap digunakan**

## Author
Adjis Ramadhani Utomo

## License
This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).