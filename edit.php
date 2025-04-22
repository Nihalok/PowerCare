<?php 
include './partials/connect.php';
include './partials/header.php';

if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$stmt = $con->prepare("SELECT * FROM user WHERE user_id = ?");
$stmt->execute([$id]);
$report = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$report) {
    $_SESSION['message'] = "Report not found!";
    $_SESSION['message_type'] = "danger";
    header("Location: index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $problem = $_POST['problem'];
    $location = $_POST['location'];
    
    try {
        $stmt = $con->prepare("UPDATE user SET user_name = ?, user_problem = ?, user_location = ? WHERE user_id = ?");
        $stmt->execute([$name, $problem, $location, $id]);
        
        $_SESSION['message'] = "Report updated successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        $_SESSION['message'] = "Error updating report: " . $e->getMessage();
        $_SESSION['message_type'] = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #030712;
            color: #e5e7eb;
        }
        .form-container {
            background-color: rgba(17, 24, 39, 0.8);
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
            border: 1px solid rgba(168, 85, 247, 0.2);
        }
        .form-control, .form-control:focus {
            background-color: rgba(31, 41, 55, 0.8);
            border: 1px solid rgba(168, 85, 247, 0.3);
            color: #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 form-container">
                <h2 class="mb-4">Edit Report</h2>
                
                <form method="POST" action="edit.php?id=<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($report['user_name']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="problem" class="form-label">Problem Description</label>
                        <textarea class="form-control" id="problem" name="problem" rows="5" required><?php echo htmlspecialchars($report['user_problem']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($report['user_location']); ?>">
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html