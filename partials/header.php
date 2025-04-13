<?php
$current_page = basename($_SERVER['PHP_SELF']);

echo '
<nav class="navbar" style="
    background-color: #030712;
    border-bottom: 1px solid rgba(168, 85, 247, 0.3);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    position: sticky;
    top: 0;
    z-index: 1000;
">
  <div style="
      display: flex;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 1rem 2rem;
      align-items: center;
  ">
    <a href="dashboard.php" style="
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: transform 0.3s ease;
    ">
      
      <span style="
          font-family: \'Inter\', sans-serif;
          font-weight: 700;
          font-size: 1.5rem;
          color: #a855f7;
          margin-left: 0.5rem;
          text-shadow: 0 0 10px rgba(168, 85, 247, 0.3);
      ">PowerCare</span>
    </a>

    <div style="
        margin-left: auto;
        display: flex;
        gap: 2rem;
        align-items: center;
    ">
      <a href="dashboard.php" style="
          text-decoration: none;
          color: '.($current_page == 'dashboard.php' ? '#a855f7' : '#e5e7eb').';
          font-weight: 500;
          transition: all 0.3s ease;
          padding: 0.5rem 0;
          position: relative;
          font-size: 0.95rem;
      ">'.($current_page == 'dashboard.php' ? '<i class="fas fa-home" style="margin-right: 0.5rem;"></i>' : '').'Home</a>
      
      <a href="posting1.php" style="
          text-decoration: none;
          color: '.($current_page == 'posting1.php' ? '#a855f7' : '#e5e7eb').';
          font-weight: 500;
          transition: all 0.3s ease;
          padding: 0.5rem 0;
          position: relative;
          font-size: 0.95rem;
      ">'.($current_page == 'posting1.php' ? '<i class="fas fa-bolt" style="margin-right: 0.5rem;"></i>' : '').'Report Issue</a>
      
      <a href="about.php" style="
          text-decoration: none;
          color: '.($current_page == 'about.php' ? '#a855f7' : '#e5e7eb').';
          font-weight: 500;
          transition: all 0.3s ease;
          padding: 0.5rem 0;
          position: relative;
          font-size: 0.95rem;
      ">'.($current_page == 'about.php' ? '<i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>' : '').'About</a>
      
      <a href="contactUs.html" style="
          text-decoration: none;
          color: '.($current_page == 'contactUs.html' ? '#a855f7' : '#e5e7eb').';
          font-weight: 500;
          transition: all 0.3s ease;
          padding: 0.5rem 0;
          position: relative;
          font-size: 0.95rem;
      ">'.($current_page == 'contactUs.html' ? '<i class="fas fa-envelope" style="margin-right: 0.5rem;"></i>' : '').'Contact</a>
      
      <div style="
          height: 24px;
          width: 1px;
          background: rgba(168, 85, 247, 0.2);
          margin: 0 1rem;
      "></div>
      
      <a href="profile.php" style="
          display: flex;
          align-items: center;
          justify-content: center;
          width: 36px;
          height: 36px;
          border-radius: 50%;
          background: rgba(168, 85, 247, 0.1);
          color: #a855f7;
          transition: all 0.3s ease;
      ">
        <i class="fas fa-user"></i>
      </a>
    </div>
  </div>
</nav>';
?>