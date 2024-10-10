# Laravel Notification System

This project implements a notification system using Laravel 11, real-time notifications via Laravel Echo, and asynchronous processing via Redis queues. The system is containerized using Docker.

## Features:
- Users can subscribe to different types of notifications (e.g., alerts, news).
- Notifications are processed asynchronously and sent via email.
- Real-time notifications are broadcasted using Laravel Echo and Socket.io.
- Containerized using Docker .

## Requirements:
- Docker compose version 23.0 or up
- Postman for Api calls or curl

## Quick Setup Instructions:

### 1. Clone the repository:
```bash
git clone https://github.com/syedahmadhussain/laravel-notification.git
cd laravel-notification
```

### 2. Install Docker and Start the Containers:
Use the `Makefile` for easy setup and container management.

#### Full installation (build, run, migrate, and seed):
```bash
make install
```

This command will:
- Build Docker containers
- Run the containers
- Install PHP dependencies
- Generate the application key
- Run database migrations
- Seed the database

#### Other useful `Makefile` commands:
- **Start the Docker containers**:
  ```bash
  make run
  ```
- **Stop the Docker containers**:
  ```bash
  make stop
  ```
- **Restart the Docker containers**:
  ```bash
  make restart
  ```
- **Run migrations**:
  ```bash
  make migrate
  ```

## Available Endpoints:

1. **Subscribe to Notification Type**:
    ``` 
   curl -X POST http://localhost:8000/users/1/subscribe \   
   -H "Content-Type: application/json" \
      -d '{"notification_type": "alert"}'
   ```

2. **Unsubscribe from Notification Type**:
   ``` 
   curl -X POST http://localhost:8000/users/1/unsubscribe \
    -H "Content-Type: application/json" \
    -d '{"notification_type": "alert"}'
   ```

3. **Trigger a Notification**:
    ```
   curl -X POST http://localhost:8000/notifications/trigger \
    -H "Content-Type: application/json" \
    -d '{"type": "alert", "message": "Important alert message!"}'
   ```

## Real-Time Notifications:

Real-time notifications are broadcast using Laravel Echo and Socket.io. Ensure the Echo server is running you can acces via browser using http://localhost:9000/notifications

## Email Notification:

Email notification are also being sent when alert is triggered and can be check using local mail server here: http://localhost:8025/

## Additional Notes:

- **Database**: MySQL is used for storing user data and notification details.
- **Queues**: Redis is used for managing Laravel queues for asynchronous notification processing.
