<?php
include 'partials/connect.php';


$user_id = 3; 

$stmt = $con->prepare("SELECT * FROM user WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        body {
            background-color: #0f172a;
            font-family: 'Segoe UI', sans-serif;
            color: #f1f5f9;
            margin: 0;
            padding: 2rem;
        }
        .profile-container {
            background: #1e293b;
            padding: 2rem;
            border-radius: 1rem;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(168, 85, 247, 0.3);
        }
        .profile-container h2 {
            color: #a855f7;
        }
        .profile-field {
            margin: 1rem 0;
        }
        .profile-field label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>User Profile</h2>
        <?php if ($user): ?>
            <div class="profile-field">
                <label>Name:</label> <?php echo htmlspecialchars($user['user_name']); ?>
            </div>
            <div class="profile-field">
                <label>Email:</label> <?php echo htmlspecialchars($user['email']); ?>
            </div>
            <!-- Add more fields as needed -->
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
