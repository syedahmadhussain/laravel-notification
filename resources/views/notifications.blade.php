<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .notification-container {
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 300px;
        }

        .notification-container h2 {
            margin-top: 0;
            font-size: 1.5rem;
        }

        .notification {
            background-color: #e0f7fa;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 5px solid #00acc1;
            border-radius: 3px;
        }

        .notification .message {
            font-size: 1rem;
        }

        .notification .status {
            color: #00796b;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<div class="notification-container">
    <h2>Real-time Notifications</h2>
    <div id="notifications">
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.iife.min.js"></script>

<script>
    const echo = new Echo({
        broadcaster: 'socket.io',
        host: window.location.hostname + ':6001'
    });

    echo.channel('laravel_database_notifications')
        .listen('NotificationSent', (event) => {
            console.log(event);
            const notificationContainer = document.getElementById('notifications');
            const notificationElement = document.createElement('div');
            notificationElement.innerHTML = `
            <p><strong>User:</strong> ${event.userId}</p>
            <p><strong>Type:</strong> ${event.type}</p>
            <p><strong>Message:</strong> ${event.message}</p>
            <p><strong>Status:</strong> ${event.status}</p>
        `;
            notificationContainer.appendChild(notificationElement);
        });

</script>

</body>
</html>
