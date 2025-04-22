<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FAQs </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .glass {
      background: rgba(30, 30, 30, 0.45);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, opacity 0.4s ease;
      opacity: 0;
    }

    .faq-item.open .faq-answer {
      max-height: 500px;
      opacity: 1;
    }
  </style>
</head>
<header class="fixed top-0 left-0 w-full z-50 bg-black bg-opacity-90 shadow-md">
      <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <div class="text-2xl font-bold text-primary">PowerCare</div>
        <nav class="space-x-6">
          <a href="dashboard.php" class="hover:text-primary transition">Home</a>
          <a href="about.php" class="hover:text-primary transition font-semibold text-primary">About</a>
        
          <a href="contactUs.html" class="hover:text-primary transition">Contact Us</a>
          <a href="faq.php" class="hover:text-primary transition">FAQ</a>
          <a href="login.php" class="hover:text-primary transition">Login</a>
        </nav>
      </div>
    </header>

<body class="bg-gradient-to-br from-blue-900 via-black to-black text-white min-h-screen flex flex-col items-center justify-center relative overflow-hidden px-4">

  <div class="glass z-10 p-10 mt-10 rounded-2xl shadow-2xl w-full max-w-4xl text-center">
    <h1 class="text-5xl font-extrabold mb-6 tracking-tight bg-gradient-to-r from-purple-400 via-pink-400 to-blue-400 text-transparent bg-clip-text">
      Frequently Asked Questions
    </h1>
    <p class="text-lg text-gray-300 mb-10">Need help? We got you. Here are some common questions about Virtual Study Room.</p>

    <div class="space-y-4 text-left">
     
      <div class="faq-item bg-gray-800/30 p-4 rounded-lg cursor-pointer border border-gray-700">
        <h3 class="text-lg font-semibold text-purple-300">What is PowerCare?</h3>
        <div class="faq-answer text-sm text-gray-300 mt-2">
        PowerCare is an online platform where users can submit feedback and report issues related to electricity services in their area. Our goal is to help electricity providers understand user concerns and improve service quality.
        </div>
      </div>

   
      <div class="faq-item bg-gray-800/30 p-4 rounded-lg cursor-pointer border border-gray-700">
        <h3 class="text-lg font-semibold text-blue-300"> How do I submit my feedback or issue on PowerCare?</h3>
        <div class="faq-answer text-sm text-gray-300 mt-2">
        Simply visit our homepage, first signup or login, click on the "Submit Feedback/Issue" button, fill out the form with your details, and describe your concern. Once submitted, our system logs it for further action and visibility to relevant authorities.
        </div>
      </div>

 
      <div class="faq-item bg-gray-800/30 p-4 rounded-lg cursor-pointer border border-gray-700">
        <h3 class="text-lg font-semibold text-green-300">What kind of issues can I report on PowerCare?</h3>
        <div class="faq-answer text-sm text-gray-300 mt-2">
          Some features like the Pomodoro timer may be usable without an account, but for full functionality — such as saving progress — you'll need to sign up.
        </div>
      </div>

      <div class="faq-item bg-gray-800/30 p-4 rounded-lg cursor-pointer border border-gray-700">
        <h3 class="text-lg font-semibold text-pink-300">Do you plan to add group study or chat features?</h3>
        <div class="faq-answer text-sm text-gray-300 mt-2">
        You can report various electricity-related issues such as:

Power outages

Voltage fluctuations

Poor service response

Billing errors

Safety concerns with electric poles/wires
        </div>
      </div>

      
      <div class="faq-item bg-gray-800/30 p-4 rounded-lg cursor-pointer border border-gray-700">
        <h3 class="text-lg font-semibold text-yellow-300">Is my personal information safe on PowerCare?</h3>
        <div class="faq-answer text-sm text-gray-300 mt-2">
        Yes, we prioritize your privacy. All user information is kept confidential and is only shared with authorized personnel for resolving the reported issues.
        </div>
      </div>
    </div>

    <div class="mt-10">
      <a href="dashboard.php" class="text-blue-400 hover:underline">← Back to Home</a>
    </div>
  </div>

 
  <script>
    document.querySelectorAll(".faq-item").forEach(item => {
      item.addEventListener("click", () => {
        item.classList.toggle("open");
      });
    });
  </script>
</body>
</html>