<?php
include("database.php");
session_start();
// $sql = "INSERT INTO `signup` (`id`, `fullname`, `email`, `hearfrom`, `registerdate`) 
//         VALUES (NULL, 'aab', 'bbb', 'bb', current_timestamp());";
// mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet" />
  <link rel="icon" href="content/img/fevv.png" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/queries.css" />
  <script
    defer
    src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
  <script defer src="script.js"></script>
  <title>Planetorium - Interstellar Travel</title>
</head>

<body>
  <header class="header">
    <a href="index.php?page=home"><img src="content/img/app/logobc.png" class="logo" /></a>
    <nav class="header-nav">
      <ul class="header-nav-list">
        <li><a class="header-nav-link" href="index.php?page=home">Home</a></li>
        <div class="dropdown">
          <li><a class="header-nav-link" href="index.php?page=products">Products &#9660;</a></li>
          <div class="dropdown-content">
            <a href="index.php?page=products">Earth-like</a>
            <a href="index.php?page=products">Watery</a>
            <a href="index.php?page=products">Ring</a>
          </div>
        </div>
        <li><a class="header-nav-link" href="index.php?page=contacts">Contacts</a></li>

        <!-- Check if user is logged in -->
        <?php if (isset($_SESSION['user'])): ?>
          <div class="user-info">
            <ion-icon class="user-icon" name="person-circle"></ion-icon>
            <div class="info">
              <p><?php echo $_SESSION['user']; ?></p>
              <p><?php echo "(" . $_SESSION['name'] . ")"; ?></p>
              <!-- Log out button -->
              <form action="logout.php" method="post" style="display: inline;">
                <input type="submit" value="Log out" class="logout-btn" />
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  echo "AAAAAAAAAAA";
                  session_unset();
                  session_destroy();
                  header('Location: index.php?page=login');
                  exit();
                }
                ?>
              </form>
            </div>
          </div>
        <?php else: ?>
          <!-- Show login and register links if not logged in -->
          <li><a class="header-nav-link" href="index.php?page=login">Login</a></li>
          <li>
            <a href="index.php?page=register" class="header-nav-link call-to-action">Sign up</a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <button class="mobile-btn">
      <ion-icon class="mobile-icon" name="menu"></ion-icon>
      <ion-icon class="mobile-icon" name="close"></ion-icon>
    </button>
  </header>
  <main>
    <section class="hero-section">
      <div class="hero">
        <div class="hero-text-box">
          <h1 class="heading">
            The perfect planet, tailored for you, straight from cosmos
          </h1>
          <p class="hero-description">
            The smart interstellar subscription that recommends and delivers
            planets perfectly suited to your needs. Tailored to your personal
            preferences and budget.
          </p>
          <a href=<?php if (!isset($_SESSION['user'])) echo "index.php?page=register";
                  else echo "index.php?page=products" ?> class="btn btn-full">Start now</a>
          <a href="#how" class="btn btn-outline">Learn more &rarr;</a>
          <div class="delivered">
            <div class="delivered-img">
              <img src="content/img/customers/customer-1.jpg" />
              <img src="content/img/customers/customer-2.jpg" />
              <img src="content/img/customers/customer-3.jpg" />
              <img src="content/img/customers/customer-4.jpg" />
              <img src="content/img/customers/customer-5.jpg" />
              <img src="content/img/customers/customer-6.jpg" />
            </div>
            <p class="delivered-text">
              <span>1,000+</span> planets delivered last year!
            </p>
          </div>
        </div>
        <div class="hero-img-box">
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <div class="tile"></div>
          <!-- <div class="shadow"></div> -->
        </div>
      </div>
    </section>
    <section class="featured-in">
      <div class="container">
        <h2>As featured in</h2>
        <div class="logos">
          <img src="content/img/logos/business-insider.png" />
          <img src="content/img/logos/forbes.png" />
          <img src="content/img/logos/techcrunch.png" />
          <img src="content/img/logos/the-new-york-times.png" />
          <img src="content/img/logos/usa-today.png" />
        </div>
      </div>
    </section>
    <section class="how-to" id="how">
      <div class="container">
        <span class="supheading">How Planetorium works</span>
        <h2 class="subheading">Your perfect planet in 3 simple steps</h2>
      </div>

      <div
        class="container grid-container"
        style="--column: 2; --r-gap: 9.6rem; --c-gap: 5rem">
        <!----------------- STEP 01 ----------------->
        <div class="step-text-box">
          <p class="step-number">01</p>
          <h3 class="subsubheading">Tell us what you need</h3>
          <p class="step-text">
            Input preferences like atmosphere, gravity, size, and available
            resources. Our AI does all the work and selects a list of planets
            just for you. Whether you're looking for a vacation spot, a mining
            hub, or a potential new home, we've got you covered.
          </p>
        </div>
        <div class="step-img-box">
          <img src="content/img/app/screen1.png" />
        </div>
        <!----------------- STEP 02 ----------------->

        <div class="step-img-box">
          <img src="content/img/app/screen2.png" />
        </div>
        <div class="step-text-box">
          <p class="step-number">02</p>
          <h3 class="subsubheading">Review your planetary options</h3>
          <p class="step-text">
            Once a week, review the list generated by Planetorium AI. You can
            filter by location, features, or even request specific criteria
            for future recommendations.
          </p>
        </div>
        <!----------------- STEP 03 ----------------->
        <div class="step-text-box">
          <p class="step-number">03</p>
          <h3 class="subsubheading">Purchase or lease</h3>
          <p class="step-text">
            Once you've found your ideal planet, you can buy or lease it
            directly from our partners. We handle all the paperwork and
            legalities, ensuring you get cosmic real estate without hassle.
            Our delivery and setup team makes it seamless!
          </p>
        </div>
        <div class="step-img-box">
          <img src="content/img/app/screen3.png" />
        </div>
      </div>
    </section>
    <section class="planets" id="products">
      <div class="container">
        <span class="supheading">Sample planets</span>
        <h2 class="subheading">
          Planetorium AI chooses from over 50,000+ celestial bodies
        </h2>
      </div>
      <div
        class="container grid-container"
        style="
            --column: 3;
            --r-gap: 9.6rem;
            --c-gap: 5rem;
            --m-bottom: 4.8rem;
          ">
        <div class="planet">
          <div class="planet-img">
            <img src="content/img/planets/planet1.png" />
          </div>
          <div class="planet-content">
            <div class="tag-area">
              <span class="tag earth-like">Earth-like</span>
            </div>

            <p class="name">Terra Nova</p>
            <ul class="planet-attributes">
              <li>
                <ion-icon name="thermometer"></ion-icon><span>Temperate climate</span>
              </li>
              <li>
                <ion-icon name="accessibility"></ion-icon><span>Gravity <strong>1.0</strong>g</span>
              </li>
              <li>
                <ion-icon name="happy"></ion-icon><span>Oxygen-rich atmosphere</span>
              </li>
              <li>
                <ion-icon name="star"></ion-icon><span><strong>4.9</strong> rating (523 reviews)</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="planet">
          <div class="planet-img">
            <img src="content/img/planets/planet2.png" />
          </div>
          <div class="planet-content">
            <div class="tag-area">
              <span class="tag watery">Watery</span>
              <span class="tag ring">Ring</span>
            </div>

            <p class="name">Aquamaris</p>
            <ul class="planet-attributes">
              <li>
                <ion-icon name="thermometer"></ion-icon><span>Subtropical ocean climate</span>
              </li>
              <li>
                <ion-icon name="accessibility"></ion-icon><span>Gravity <strong>0.8</strong>g</span>
              </li>
              <li>
                <ion-icon name="happy"></ion-icon><span>All water</span>
              </li>
              <li>
                <ion-icon name="star"></ion-icon><span><strong>4.8</strong> rating (617 reviews)</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="categories">
          <h3 class="subsubheading">
            Planetorium works with any kind of planet
          </h3>
          <ul class="list">
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Habitable Earth-like planets</span>
            </li>
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Gas giants</span>
            </li>
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Icy worlds</span>
            </li>
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Water planets</span>
            </li>
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Rocky exoplanets</span>
            </li>
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Binary planets</span>
            </li>
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Resource-rich asteroids</span>
            </li>
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Orbiting moons</span>
            </li>
            <li class="item">
              <ion-icon class="planet-icon" name="planet"></ion-icon>
              <span>Dwarf planets</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="container recipies">
        <a href="index.php?page=products" class="link">See all planets &rarr;</a>
      </div>
    </section>
    <section
      class="testimonials-section grid-container"
      id="testimonials"
      style="--column: 2">
      <div class="testimonial-container">
        <h3 class="supheading">Testimonial</h3>
        <h2 class="subheading">
          You will never come back once arriving to your new destination
        </h2>
        <div
          class="testimonials grid-container"
          style="--column: 2; --r-gap: 4.8rem; --c-gap: 6.4rem">
          <figure class="testimonial">
            <img
              class="testimonial-img"
              src="content/img/customers/dave.jpg" />
            <blockquote class="testimonial-text">
              I found the perfect planet for my new vacation home! Thanks to
              Planetorium, it was a stress-free process!
            </blockquote>
            <p class="testimonial-author">&mdash;David Palmer</p>
          </figure>
          <figure class="testimonial">
            <img
              class="testimonial-img"
              src="content/img/customers/ben.jpg" />
            <blockquote class="testimonial-text">
              The AI recommended a mining hub on a distant asteroid that
              increased our company's resources tenfold!
            </blockquote>
            <p class="testimonial-author">&mdash;Ken Adams</p>
          </figure>
          <figure class="testimonial">
            <img
              class="testimonial-img"
              src="content/img/customers/hannah.jpg" />
            <blockquote class="testimonial-text">
              We're now proud owners of a beautiful water planet where my
              family plans to live part-time.
            </blockquote>
            <p class="testimonial-author">&mdash;Sophia Wallace</p>
          </figure>
          <figure class="testimonial">
            <img
              class="testimonial-img"
              src="content/img/customers/steve.jpg" />
            <blockquote class="testimonial-text">
              Planetorium made finding a safe, habitable planet for our colony
              so easy. We're thriving on our new world.
            </blockquote>
            <p class="testimonial-author">&mdash;Nova Solaris</p>
          </figure>
        </div>
      </div>
      <div
        class="gallery grid-container"
        style="--column: 3; --r-gap: 1.2rem; --c-gap: 1.2rem">
        <figure class="gallery-item">
          <img src="content/img/planets/planet1.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet2.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet3.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet13.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet14.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet15.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet7.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet8.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet9.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet10.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet11.png" />
        </figure>
        <figure class="gallery-item">
          <img src="content/img/planets/planet12.png" />
        </figure>
      </div>
    </section>
    <section class="pricing" id="pricing">
      <div class="container">
        <span class="supheading">Pricing</span>
        <h2 class="subheading">A planet a day keeps the sorrow away!</h2>
      </div>
      <div
        class="container grid-container planner"
        style="--column: 2; --c-gap: 9.6rem; --m-bottom: 9.6rem">
        <!-------------- Plan 1 ---------------->
        <div class="plan plan-1">
          <div class="plan-header">
            <p class="plan-name">Starter</p>
            <p class="plan-price">
              <span class="dollar">$</span>199<span class="zero">,000,000</span>
            </p>
            <p class="plan-text">
              per month. That's just $50<span class="zero">,000,000</span>
              per week for an interstellar journey!
            </p>
          </div>
          <ul class="list">
            <li class="item">
              <ion-icon name="checkmark-circle" class="checkmark"></ion-icon>
              <span>1 planet visit per week</span>
            </li>
            <li class="item">
              <ion-icon name="checkmark-circle" class="checkmark"></ion-icon>
              <span>General planetary listings</span>
            </li>
            <li class="item">
              <ion-icon name="checkmark-circle" class="checkmark"></ion-icon>
              <span>Legal documentation included</span>
            </li>
            <li class="item">
              <ion-icon name="close-circle" class="checkmark"></ion-icon>
              <span></span>
            </li>
          </ul>
          <div class="plan-sign-up">
            <a href="#" class="btn btn-outline">Start your journey</a>
          </div>
        </div>
        <!-------------- Plan 2 ---------------->
        <div class="plan plan-2">
          <div class="plan-header">
            <p class="plan-name">Complete</p>
            <p class="plan-price">
              <span class="dollar">$</span>999<span class="zero">,000,000</span>
            </p>
            <p class="plan-text">
              per month. That's just $33<span class="zero">,000,000</span> per
              day for an interstellar journey!
            </p>
          </div>
          <ul class="list">
            <li class="item">
              <ion-icon name="checkmark-circle" class="checkmark"></ion-icon>
              <span>1 planet visit <strong>everyday</strong></span>
            </li>
            <li class="item">
              <ion-icon name="checkmark-circle" class="checkmark"></ion-icon>
              <span>Rare celestial bodies and newly discovered planets</span>
            </li>
            <li class="item">
              <ion-icon name="checkmark-circle" class="checkmark"></ion-icon>
              <span>Legal documentation included</span>
            </li>
            <li class="item">
              <ion-icon name="checkmark-circle" class="checkmark"></ion-icon>
              <span><strong>15%</strong> off for first transaction!</span>
            </li>
          </ul>
          <div class="plan-sign-up">
            <a href="#" class="btn btn-full">Start your journey</a>
          </div>
        </div>
      </div>
      <div class="container">
        <aside class="refunds">
          Prices include all applicable taxes. Costumers can cancel at any
          time. Both plans contain the following:
        </aside>
      </div>
      <div
        class="container grid-container features"
        style="--column: 4; --c-gap: 9.6rem">
        <div class="feature">
          <ion-icon class="feature-icon" name="infinite"></ion-icon>
          <p class="feature-title">No more guesswork</p>
          <p class="feature-text">
            Our system curates a list of planets based on your specific needs.
          </p>
        </div>
        <div class="feature">
          <ion-icon class="feature-icon" name="earth"></ion-icon>
          <p class="feature-title">Exclusive planetary access</p>
          <p class="feature-text">
            Get first dibs on newly discovered planets and rare celestial
            bodies.
          </p>
        </div>
        <div class="feature">
          <ion-icon class="feature-icon" name="sparkles"></ion-icon>
          <p class="feature-title">Eco-friendly exploration</p>
          <p class="feature-text">
            We ensure all our planets meet environmental and safety standards.
          </p>
        </div>
        <div class="feature">
          <ion-icon class="feature-icon" name="time"></ion-icon>
          <p class="feature-title">Pause or upgrade anytime</p>
          <p class="feature-text">
            Need a break? Pause your subscription or upgrade to explore
            multiple galaxies!
          </p>
        </div>
      </div>
    </section>
    <!-- <section class="call-to-action" id="register">
      <div class="container">
        <div class="cta grid-container" style="--column: 2">
          <div class="cta-box">
            <h2 class="subheading">
              Enjoy your first interstellar journey for free!
            </h2>
            <p class="cta-text">
              Discover your next world with our free interstellar tour. The
              first visit is on us — no strings attached. Pause or cancel
              anytime!
            </p>

            <form class="cta-form" name="form" method="post">
              <div
                class="grid-container"
                style="--column: 2; --c-gap: 3.2rem; --r-gap: 2.4rem">
                <div>
                  <label for="name"> Full name:</label>
                  <input name="name" type="text" id="name"
                    placeholder="XiTrumbumbum" required />
                </div>
                <div>
                  <label for="email"> Email:</label>
                  <input
                    name="mail"
                    type="email"
                    id="email"
                    placeholder="dokhang@example.com"
                    required />
                </div>
                <div>
                  <label for="where">Where did you hear from us?</label>
                  <select name="select" id="where" required>
                    <option value="">Choose one</option>
                    <option value="1">Family and friends</option>
                    <option value="2">Social media</option>
                    <option value="3">YouTube</option>
                    <option value="4">Others</option>
                  </select>
                </div>
                <div class="buttons">
                  <button class="btn btn-full">Sign up</button>
                  <button class="btn btn-outline"
                    onclick="document.getElementById('id01').style.display='block'">Login</button>
                </div>
              </div>
            </form>

          </div>
          <div class="cta-img"></div>
        </div>
      </div>
    </section> -->
  </main>

  <footer>
    <div
      class="grid-container"
      style="--column: 5; --c-gap: 6.4rem; --r-gap: 9.6rem">
      <!------------ Logo ------------>
      <div class="logo-section">
        <a href="#"><img src="content/img/app/logobc.png" class="logo" /></a>
        <ul class="social-networks">
          <li>
            <a href="#"><ion-icon class="social-icon" name="logo-facebook"></ion-icon></a>
          </li>
          <li>
            <a href="#"><ion-icon class="social-icon" name="logo-tiktok"></ion-icon></a>
          </li>
          <li>
            <a href="#"><ion-icon class="social-icon" name="logo-skype"></ion-icon></a>
          </li>
          <li>
            <a href="#"><ion-icon class="social-icon" name="logo-discord"></ion-icon></a>
          </li>
          <li>
            <a href="#"><ion-icon class="social-icon" name="logo-twitter"></ion-icon></a>
          </li>
        </ul>
        <p class="copyright">
          Copyright &copy; by Planetorium, Inc. All rights reserved.
        </p>
      </div>
      <!------------ Contacts ------------>
      <div class="contacts">
        <p class="footer-heading">Contact us</p>
        <ul class="footer-nav">
          <li class="address">
            1 Galactic Way, Sector 7, Galaxy Cluster A3B
          </li>
          <li>&nbsp;</li>
          <li><a href="tel:919-263-1770">2252297</a></li>
          <li>
            <a href="mailto:XiTrumbumbum@planetorium.com">khang.mackhang@hcmut.edu.vn</a>
          </li>
        </ul>
      </div>
      <!------------ Company ------------>
      <nav>
        <p class="footer-heading">Company</p>
        <ul class="footer-nav">
          <li><a href="#">About Planetorium</a></li>
          <li><a href="#">For Businesses</a></li>
          <li><a href="#">Celestial Partners</a></li>
          <li><a href="#">Careers</a></li>
        </ul>
      </nav>
      <!------------ Account ------------>
      <nav>
        <p class="footer-heading">Account</p>
        <ul class="footer-nav">
          <li><a href="#">Create account</a></li>
          <li><a href="#">Sign in</a></li>
          <li><a href="#">iOS app</a></li>
          <li><a href="#">Android app</a></li>
        </ul>
      </nav>
      <!------------ Resources ------------>
      <nav>
        <p class="footer-heading">Resources</p>
        <ul class="footer-nav">
          <li><a href="#">Planet Directory</a></li>
          <li><a href="#">Help Center</a></li>
          <li><a href="#">Privacy & Terms</a></li>
        </ul>
      </nav>
    </div>
  </footer>

  <script
    type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script
    nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>

<?php
mysqli_close($conn);
?>