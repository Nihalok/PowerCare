<?php 
include './partials/connect.php';
include './partials/header.php';

if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    try {
        $stmt = $con->prepare("SELECT user_images FROM user WHERE user_id = ?");
        $stmt->execute([$delete_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user) {
            $images = json_decode($user['user_images'], true);
            if(is_array($images)) {
                foreach($images as $image) {
                    if(file_exists($image)) {
                        unlink($image);
                    }
                }
            }
            
            $stmt = $con->prepare("DELETE FROM user WHERE user_id = ?");
            $stmt->execute([$delete_id]);
            
            $_SESSION['message'] = "Report deleted successfully!";
            $_SESSION['message_type'] = "success";
        }
    } catch(PDOException $e) {
        $_SESSION['message'] = "Error deleting report: " . $e->getMessage();
        $_SESSION['message_type'] = "danger";
    }
    
    header("Location: index.php");
    exit();
}

$searchQuery = "";
$params = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%";
    $searchQuery = " WHERE user_problem LIKE :search OR user_name LIKE :search ";
    $params[':search'] = $search;
}

$sql = "SELECT * FROM user" . $searchQuery;
$stmt = $con->prepare($sql);
$stmt->execute($params);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PowerCare - Reports</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary: #a855f7;
      --primary-dark: #7e22ce;
      --dark: #111827;
      --light: #f3f4f6;
      --gray: #6b7280;
      --dark-bg: #030712;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--dark-bg);
      color: #e5e7eb;
      background-image: 
        radial-gradient(at 80% 0%, hsla(189, 100%, 56%, 0.1) 0px, transparent 50%),
        radial-gradient(at 0% 50%, hsla(355, 100%, 93%, 0.1) 0px, transparent 50%);
    }

    .navbar {
      background-color: rgba(17, 24, 39, 0.8);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(168, 85, 247, 0.2);
    }

    .navbar-brand {
      color: var(--primary);
      font-weight: 700;
      font-size: 1.5rem;
    }

    .search-form {
      display: flex;
      justify-content: center;
      margin-bottom: 30px;
      margin-top: 40px;
      animation: fadeInDown 0.8s ease-out;
    }

    .search-form .input-group {
      width: 50%;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      border-radius: 30px;
      overflow: hidden;
    }

    .search-form input {
      padding: 15px 25px;
      font-size: 16px;
      border: none;
      background: rgba(255,255,255,0.9);
      transition: all 0.3s ease;
    }

    .search-form input:focus {
      background: white;
      box-shadow: none;
    }

    .search-form button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 15px 30px;
      transition: all 0.3s ease;
    }

    .search-form button:hover {
      background: var(--dark);
    }

    .card {
      border: none;
      border-radius: 15px;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      background-color: rgba(17, 24, 39, 0.8);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      margin-bottom: 30px;
      border: 1px solid rgba(168, 85, 247, 0.2);
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.6s forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }
    .card:nth-child(5) { animation-delay: 0.5s; }
    .card:nth-child(6) { animation-delay: 0.6s; }

    .card-img-top {
      height: 220px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .card:hover .card-img-top {
      transform: scale(1.05);
    }

    .card-body {
      padding: 25px;
    }

    .card-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #e5e7eb;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }

    .card-title:after {
      content: '';
      position: absolute;
      width: 50%;
      height: 3px;
      background: var(--primary);
      bottom: -8px;
      left: 0;
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s ease;
    }

    .card:hover .card-title:after {
      transform: scaleX(1);
    }

    .card-text {
      color: var(--gray);
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .btn-primary {
      background: var(--primary);
      border: none;
      border-radius: 30px;
      padding: 10px 20px;
      font-weight: 500;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(168, 85, 247, 0.3);
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(168, 85, 247, 0.4);
    }

    .dropdown-menu {
      background-color: rgba(17, 24, 39, 0.9);
      border: 1px solid rgba(168, 85, 247, 0.2);
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      border-radius: 10px;
      overflow: hidden;
    }

    .dropdown-item {
      color: #e5e7eb;
      padding: 10px 15px;
      transition: all 0.2s ease;
    }

    .dropdown-item:hover {
      background: var(--primary);
      color: white;
      padding-left: 20px;
    }

    .no-users {
      text-align: center;
      font-size: 1.2rem;
      color: #e5e7eb;
      padding: 80px 0;
      animation: fadeIn 1s ease-out;
    }

    .no-users i {
      font-size: 3rem;
      color: var(--primary);
      margin-bottom: 20px;
      display: block;
    }

    .floating {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }

    .pulse {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(168, 85, 247, 0.4); }
      70% { box-shadow: 0 0 0 15px rgba(168, 85, 247, 0); }
      100% { box-shadow: 0 0 0 0 rgba(168, 85, 247, 0); }
    }

    @media(max-width: 768px) {
      .search-form .input-group {
        width: 90%;
      }
      
      .card {
        margin-bottom: 20px;
      }
    }
    .btn-danger{
      background-color: var(--primary);
      border: none;
      border-radius: 30px;
      padding: 10px 20px;
      font-weight: 500;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      width: 50px;
      height: 50px;
    }
    .btn-warning{
      background-color: var(--primary);
      border: none;
      border-radius: 30px;
      padding: 10px 20px;
      font-weight: 500;
      letter-spacing: 0.1px;
      transition: all 0.3s ease;
      width: 50px;
      height: 50px;
    }
    .btn-warning i{
      margin-top: 8px;
    }
    .btn-danger1{
      background-color: var(--primary);
      border: none;
      border-radius: 30px;
      padding: 10px 20px;
      font-weight: 500;
      letter-spacing: 0.1px;
      transition: all 0.3s ease;
    }
  </style>
</head>

<body>

<?php if(isset($_SESSION['message'])): ?>
    <div class="container mt-3">
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
<?php endif; ?>

<div class="container">
  <form method="GET" action="index.php" class="search-form">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search reports by name or issue..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
      <button class="btn" type="submit"><i class="fas fa-search"></i> Search</button>
    </div>
  </form>
</div>

<div class="container py-5">
  <?php if($users): ?>
    <div class="row">
      <?php
      foreach ($users as $index => $row) {
        $userImages = isset($row["user_images"]) ? json_decode($row["user_images"], true) : [];
        $firstImage = !empty($userImages) ? $userImages[0] : "images/default.png";
        
        echo '<div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="overflow-hidden" style="height: 220px;">
                    <img src="' . htmlspecialchars($firstImage) . '" class="card-img-top w-100 h-100" alt="Report Image">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($row["user_name"]) . '</h5>
                    <p class="card-text">' . htmlspecialchars(substr($row["user_problem"], 0, 100)) . '...</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <a href="stories.php?story_id=' . $row['user_id'] . '" class="btn btn-primary">
                        <i class="fas fa-book-open me-2"></i>View Report
                      </a>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal'.$row['user_id'].'">
                        <i class="fas fa-trash me-2"></i>
                      </button>
                      <a href="edit.php?id=' . $row['user_id'] . '" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>
                      </a>
                      <div class="dropdown">
                        <button class="btn btn-outline-secondary rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-share-alt"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=' . urlencode("http://yourwebsite.com/stories.php?story_id=" . $row['user_id']) . '" target="_blank"><i class="fab fa-facebook me-2"></i>Facebook</a></li>
                          <li><a class="dropdown-item" href="https://twitter.com/intent/tweet?url=' . urlencode("http://yourwebsite.com/stories.php?story_id=" . $row['user_id']) . '" target="_blank"><i class="fab fa-twitter me-2"></i>Twitter</a></li>
                          <li><a class="dropdown-item" href="https://api.whatsapp.com/send?text=Check out this report: http://yourwebsite.com/stories.php?story_id=' . $row['user_id'] . '" target="_blank"><i class="fab fa-whatsapp me-2"></i>WhatsApp</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
              
        echo '<div class="modal fade" id="deleteModal'.$row['user_id'].'" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content bg-dark text-light">
                    <div class="modal-header border-0">
                      <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this report? This action cannot be undone.
                    </div>
                    <div class="modal-footer border-0">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <a href="index.php?delete_id='.$row['user_id'].'" class="btn btn-danger1">Delete</a>
                    </div>
                  </div>
                </div>
              </div>';
      }
      ?>
    </div>
  <?php else: ?>
    <div class="no-users animate__animated animate__fadeIn">
      <i class="fas fa-book-open floating"></i>
      <h3>No reports found</h3>
      <p class="text-muted">Try a different search term or check back later</p>
      <a href="index.php" class="btn btn-primary mt-3 pulse">View All Reports</a>
    </div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    function animateCards() {
      $('.card').each(function(i) {
        var card = $(this);
        var cardPosition = card.offset().top;
        var scrollPosition = $(window).scrollTop() + $(window).height();
        
        if (scrollPosition > cardPosition) {
          setTimeout(function() {
            card.css('opacity', '1').css('transform', 'translateY(0)');
          }, 200 * i);
        }
      });
    }
  
    animateCards();
    
    $(window).scroll(function() {
      animateCards();
    });
    
    $('.card').hover(
      function() {
        $(this).css('transform', 'translateY(-10px)');
        $(this).css('box-shadow', '0 15px 30px rgba(0,0,0,0.15)');
      },
      function() {
        $(this).css('transform', 'translateY(0)');
        $(this).css('box-shadow', '0 5px 15px rgba(0,0,0,0.08)');
      }
    );
    
    setTimeout(function() {
      $('.alert').alert('close');
    }, 5000);
  });
</script>

</body>
</html>

<?php $con = null; ?>