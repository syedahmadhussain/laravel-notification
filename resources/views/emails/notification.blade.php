<!DOCTYPE html>
<html>
<head>
    <title>New Notification</title>
</head>
<body>
<h1>{{ ucfirst($notification->type) }}</h1>
<p>{{ $notification->message }}</p>
<p>Thank you for using our application!</p>
</body>
</html>
