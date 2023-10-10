<?php
include 'head.inc.php';
include 'header.php';
include 'menu.php';

?>



<!-- MAIN -->
<main role="main">
  <!-- Content -->
  <article>
    <header class="section background-dark">
      <div class="line">
        <?php
        $aboutPageContent = $AboutPageManager->getAboutPageTitleAndParagraph();
        foreach ($aboutPageContent as $AboutPageTitleAndParagraph) {
          ?>        
          <h1 class="text-white margin-top-bottom-40 text-size-60 text-line-height-1"><?php echo $AboutPageTitleAndParagraph->getTitle(); ?></h1>
          <p class="margin-bottom-0 text-size-16"><?php echo $AboutPageTitleAndParagraph->getParagraph(); ?></p>
        </div> 
        <?php
      }
      ?> 
    </header>

    
<!-- TEAM -->
<?php
$section = 'Team';
$serviceVisibilityObject = $VisibilityManager->getVisibilityBySection($section);
$serviceVisibility = $serviceVisibilityObject->getIsVisible();


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
       // end of if statement isVisible
      ?>
  </main>


  <?php include 'footer.php'; ?>