<footer class="site-footer">

    <div class="site-footer__inner container container--narrow">

      <div class="group">

        <div class="site-footer__col-one">
          <h1 class="school-logo-text school-logo-text--alt-color"><a href="<?php echo site_url(); ?>"><strong>Fictional</strong> University</a></h1>
          <p><a class="site-footer__link" href="#">555.555.5555</a></p>
        </div>

        <div class="site-footer__col-two-three-group">
          <div class="site-footer__col-two">
            <h3 class="headline headline--small">Explore</h3>
            <nav class="nav-list"> 
              <!-- <ul class="nav-list min-list">
                <li><a href="<?php echo site_url('/about-us') ?>">About Us</a></li>
                <li><a href="#">Programs</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Campuses</a></li>
              </ul> -->
              <?php wp_nav_menu([
                'theme_location' => 'Footerlocation1',
              ]); ?>
            </nav>
          </div>

          <div class="site-footer__col-three">
            <h3 class="headline headline--small">Learn</h3>
            <nav class="nav-list">
              <?php wp_nav_menu([
                'theme_location' => 'Footerlocation2',
              ]); ?>
              <!-- <ul class="nav-list min-list">
                <li><a href="#">Legal</a></li>
                <li><a href="<?php echo site_url('/privacy-policy') ?>">Privacy</a></li>
                <li><a href="#">Careers</a></li>
              </ul> -->
            </nav>
          </div>
        </div>

        <div class="site-footer__col-four">
          <h3 class="headline headline--small">Connect With Us</h3>
          <nav>
            <ul class="min-list social-icons-list group">
              <li><a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </footer>
  <!-- search-overlay--active -->
  <div class="search-overlay">
    <div class="search-overlay_top">
      <div class="container">
        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
        <input type="text" name="" id="search-term" class="search-term" placeholder="What are u looking for?">
        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
      </div>
    </div>
    <div class="container">
        <div id="search-overlay__results">
        <!-- <h2 class="search-overlay__section-title"></h2>
        <ul class ="link-list min-list">
                <li><a href="#"></a></li>
        </ul> -->
        </div>
    </div>
  </div>

<?php wp_footer(); ?>
</body>
</html>