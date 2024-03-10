<?php
session_start();

 
if (isset($_POST['loggedin'])) {
    $username = $_POST['user'];
    $_SESSION['user'] = $username;
   exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/kollohmbia/css/welcomestyle.css">
  
</head>
<body>
   <header>
       >
        <h1>Welcome, <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest'; ?></h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="checkBMI.php">Health Tips</a></li>
                <li><a href="#">Fitness Classes</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Profile</a></li>
            </ul>
        </nav>
    </header>
  
    <div class="content">
            <div class="slideshow-container">
                <div class="slideshow-wrapper">
                    <div class="section section-a">
                            <h2>Health Tips</h2>
                            <p>"Embrace a healthy lifestyle with these straightforward tips. Discover the benefits of intermittent fasting, a proven method for improved metabolism. Stay hydrated by incorporating regular water intake, supporting digestion and bodily functions. Elevate your well-being through consistent exercise—whether it's a brisk walk, yoga, or weight training. Maintain a balanced diet rich in fruits, vegetables, lean proteins, and whole grains while limiting processed foods. Prioritize 7-9 hours of quality sleep for optimal recovery. For deeper insights into these practices, click 'Learn More.' Unlock personalized advice and in-depth information to kickstart your journey toward a healthier, happier you."</p>
                             <a href="checkBMI.php" class="learn-more">Learn More</a>
                     </div>
                     <div class="section section-b">
                            <h2>Fitness Classes</h2>
                            <p>"Embark on an invigorating fitness journey with a diverse range of classes, including the transformative power of High-Intensity Training (HIT) and High-Intensity Interval Training (HIIT). Experience the dynamic benefits of HIT, a comprehensive workout emphasizing intensity and efficiency. Dive into HIIT, a strategic blend of intense bursts and rest periods, maximizing calorie burn and cardiovascular fitness. Explore breathing techniques, gym workouts targeting push-pull, leg, and resistance training, bodyweight exercises, and energizing morning runs. Unleash the potential of your fitness routine with our expertly curated classes. Click 'Learn More' for detailed insights, guiding you towards a balanced, resilient, and energetic lifestyle."</p>
                            <a href="#fitness-classes" class="learn-more">Learn More</a>
                     </div>
                     <div class="section section-c">
                            <h2>Events</h2>
                            <p>"Immerse yourself in a diverse array of engaging events designed to enrich your experiences. From adventurous campings under the stars to informative health seminars offering valuable insights, there's something for everyone. Feel the rhythm and joy with lively dance events that promise entertainment and a good workout. Explore our event calendar for a curated selection that spans campings, health seminars, dance sessions, and more. Click 'Learn More' to discover detailed information about each event, ensuring you stay connected with a vibrant community and make the most of every opportunity to learn, grow, and connect with like-minded individuals."</p>
                            <a href="#events" class="learn-more">Learn More</a>
                    </div>
                    <div class="section section-d">
                            <h2>Community</h2>
                             <p>"Dive into a thriving community where connections flourish and shared interests thrive. Join discussions, share experiences, and forge meaningful relationships with like-minded individuals. Whether you're passionate about fitness, well-being, or simply looking to connect, our community is a welcoming space for all. Engage in lively forums, attend community events, and explore collaborative initiatives. Click 'Learn More' to discover the diverse facets of our community, where support, inspiration, and a sense of belonging await. Unleash the power of shared experiences and foster connections that contribute to a vibrant, supportive, and uplifting community."</p>
                            <a href="#community" class="learn-more">Learn More</a>
                     </div>
                      <div class="section section-e">
                             <h2>Contact</h2>
                             <p>"Connect with us effortlessly through our dedicated contact channel. Have questions, feedback, or inquiries? Reach out to us for prompt assistance and personalized support. Our team is here to ensure your experience is seamless and your concerns are addressed. Click 'Learn More' to access detailed contact information, opening hours, and convenient communication channels. We value your input and look forward to hearing from you. Stay connected, and let us be your reliable resource for any information or assistance you may need. Your satisfaction is our priority, and we're just a click away from enhancing your interaction with us." Learn More</p>
                             <a href="#contact" class="learn-more">Learn More</a>
                    </div>
                    <div class="section section-f">
                             <h2>Profile</h2>
                              <p>Create your profile to access personalized features. Learn More</p>
                              <a href="http://localhost/kollohmbia/register_process.php" class="learn-more">CREATE</a>
                     </div>
                 </div>
            </div>
    </div>



    <?php if (isset($_SESSION['user'])): ?>
        <section class="profile">
            <h2>Your Badge</h2>
            <!-- Display the user's badge information here -->
            <p>Badge Name: <?php echo $badge_name; ?></p>
            <p>Badge Description: <?php echo $badge_description; ?></p>
            <p>Badge Image: <img src="<?php echo $badge_image ?>"></p>
        </section>
    <?php endif; ?>
      <script src="/kollohmbia/js/welcomescript.js" ></script>
</body>
</html>