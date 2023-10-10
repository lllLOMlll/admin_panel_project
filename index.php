<?php
include 'head.inc.php';
include 'header.php';
include 'menu.php';

?>



<!-- MAIN -->
<main role="main">    
  <!-- Main Header -->
  <header>
    <div class="carousel-default owl-carousel carousel-main carousel-nav-white background-dark text-center">
      <div class="item">
        <div class="s-12">
          <img src="img/header.jpg" alt="">
          <div class="carousel-content">
            <div class="content-center-vertical line">
              <div class="margin-top-bottom-80">
                <!-- TITLE -->
                <h1 class="text-white margin-bottom-30 text-size-60 text-m-size-30 text-line-height-1 mt-3">
                  <?php
                  $TitleAndWelcomeMessages = $TitleAndWelcomeMessageManager->getTitleAndWelcomeText();
                  foreach ($TitleAndWelcomeMessages as $TitleAndWelcomeMessage) {
                    $title = $TitleAndWelcomeMessage->getTitle();
                    echo $title;
                  }
                  ?>
                </h1>
                <div class="s-12 m-10 l-8 center">
                  <!-- WELCOME TEXT -->
                  <p class="text-white text-size-14 margin-bottom-40">
                   <?php
                   $TitleAndWelcomeMessages = $TitleAndWelcomeMessageManager->getTitleAndWelcomeText();
                   foreach ($TitleAndWelcomeMessages as $TitleAndWelcomeMessage) {
                    $paragraph = $TitleAndWelcomeMessage->getParagraph();
                    echo $paragraph;
                  }
                  ?>
                </p>
              </div>
              <div class="line">
                <div class="s-12 m-12 l-3 center">
                  <a class="button button-white-stroke s-12" href="contact.php">Get Started Now</a>
                </div>       
              </div>  
            </div>
          </div>
        </div>
      </div>
    </div>              
  </div>               
</header>



<!-- SERVICE -->
<!-- isVisible -->
<?php
$section = 'Services';
$serviceVisibilityObject = $VisibilityManager->getVisibilityBySection($section);
$serviceVisibility = $serviceVisibilityObject->getIsVisible();

if ($serviceVisibility == 1) { 
  ?>

  <section class="section-small-padding background-white text-center"> 
   <h2 class="text-size-50 text-m-size-40 text-center">
    <?php
    $titleObject = $ServicesManager->getTitle();
    $title = $titleObject->getTitle();
    echo $title; 
    ?>
  </h2>
  <hr class="break-small background-primary break-center">
  <div class="margin" style="display: flex; flex-wrap: wrap; justify-content: center;">
    <?php
    $services = $ServicesManager->getAllServices();

    foreach ($services as $service) {
      ?>
      <div class="s-12 m-12 l-4 margin-m-bottom">
        <div class="padding-2x block-bordered">
          <i class="<?php echo $service->getIcon(); ?> icon3x text-dark center margin-bottom-30"></i>
          <h2 class="text-thin"><?php echo $service->getTitle(); ?></h2>
          <p class="margin-bottom-30"><?php echo $service->getDescription(); ?></p>
          <a class="button button-dark-stroke text-size-12" href="contact.php"><?php echo $service->getButtonText(); ?></a>
        </div>
      </div>
      <?php
    } // end of the foreach loop
    ?>
  </div>
</section>
<?php
} // end of if statement isVisible
?>


<!-- TEAM -->
<?php
$section = 'Team';
$serviceVisibilityObject = $VisibilityManager->getVisibilityBySection($section);
$serviceVisibility = $serviceVisibilityObject->getIsVisible();

if ($serviceVisibility == 1) { 
  ?>
<section class="section background-white text-center">
  <div class="line">
 <?php
  $titles = $TeamManager->getAllTeamTitle();
  foreach ($titles as $title) {
    echo '<h2 class="text-size-50 text-m-size-40 text-center">' . $title->getTitle() . '</h2>';
  }
?>
    <hr class="break-small background-primary break-center">
    <div class="carousel-default owl-carousel carousel-wide-arrows">
      <?php
      $allTeam = $TeamManager->getAllTeam();

      foreach ($allTeam as $singleTeamMember) {
        ?>
        <div class="item">
          <div class="s-12 m-12 l-7 center text-center">
            <img class="image-testimonial-small" src="<?php echo $singleTeamMember->getPicturePath(); ?>" alt="<?php echo $singleTeamMember->getAlt(); ?>" style="width: 100px; height: 100px; object-fit: cover;">
            <p class="h1 text-size-16"><?php echo $singleTeamMember->getName(); ?> / <?php echo $singleTeamMember->getTitle(); ?></p>
            <p class="h1 margin-bottom text-size-20"><?php echo $singleTeamMember->getBio(); ?></p>
          </div>
        </div>

        <?php
      } // End of foreach loop
      ?>
    </div>
  </div>
</div>
</section>
    <?php
      } // end of if statement isVisible
      ?>




<!-- PORTFOLIO -->
<!-- isVisible -->
<?php
$section = 'Portfolio';
$sliderVisibilityObject = $VisibilityManager->getVisibilityBySection($section);
$sliderVisibility = $sliderVisibilityObject->getIsVisible();

if ($sliderVisibility == 1) {
?>
  <section class="section-top-padding full-width">
       <h2 class="text-size-50 text-m-size-40 text-center">
    <?php
    $titleObject = $PortfolioManager->getTitle();
    $title = $titleObject->getTitle();
    echo $title; 
    ?>
  </h2>
    <hr class="break-small background-primary break-center">
    <div class="section background-white">
      <div class="line">
        <div class="margin text-center" style="display: flex; flex-wrap: wrap;">
          <?php
          $portfolios = $PortfolioManager->getAllPortfolio();
          foreach ($portfolios as $portfolio) {
          ?>
            <!-- Start of row -->
            <div class="s-12 m-4 l-4 margin-m-bottom" style="flex: 0 0 calc(33.3333% - 10px); max-width: calc(33.3333% - 10px); margin: 5px;">
              <div class="image-with-hover-overlay image-hover-zoom margin-bottom">
                <div class="image-hover-overlay background-primary">
                  <div class="image-hover-overlay-content text-center padding-2x">
                    <p><?php echo $portfolio->getDescription(); ?></p>
                  </div>
                </div>
                <img src="<?php echo $portfolio->getImagePath(); ?>" alt="<?php echo $portfolio->getAlt(); ?>" title="Portfolio Image 1" style="max-width: 100%; height: auto;" />
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <style>
    /* For small screens */
/* For small screens */
@media (max-width: 768px) {
  .s-12 {
    flex: 0 0 calc(100% - 10px);
    max-width: calc(100% - 10px);
  }
  .s-12 img {
    width: 100%;
    height: auto; /* keeping aspect ratio */
    /* Optional: Add some padding or margin if you wish */
    margin-top: 10px;
    margin-bottom: 10px;
  }
}

  </style>
<?php
} // end of if statement isVisible
?>


<!-- SLIDER -->
<!-- isVisible -->
<?php
$section = 'Slider';
$sliderVisibilityObject = $VisibilityManager->getVisibilityBySection($section);
$sliderVisibility = $sliderVisibilityObject->getIsVisible();

if ($sliderVisibility == 1) {
  ?>


  <!-- if empty     -->
  <?php
  $slideList = $SliderManager->getAllSlides();

  if (!empty($slideList)) {
    ?>

    <!-- SLIDER -->
    <section class="section background-white text-center">
      <div class="line">
        <h2 class="text-size-50  text-m-size-40 text-center">
          <?php
          $titleObject = $SliderManager->getTitle();
          $sliderTitle = $titleObject->getTitle();
          echo $sliderTitle;
          ?>  
        </h2>
        <hr class="break-small background-primary break-center">
        <div class="carousel-default owl-carousel carousel-wide-arrows">
          <?php
          foreach ($slideList as $slide) {
            ?>
            <div class="item">
              <div class="s-12 m-12 l-7 center text-center">
                <div style="display: flex; justify-content: center;">
                  <img src="<?php echo $slide->getSlidePath(); ?>" alt="<?php echo $slide->getAlt(); ?>" style="width: 300px; height: auto;">
                </div>
                <br>
                <p class="h1 text-size-16"><?php echo $slide->getTitle(); ?></p>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </section>

    <?php
} // end of if statement if empty
?>

<?php
} // end of if statement isVisible
?>


</main>

<?php include 'footer.php';?>