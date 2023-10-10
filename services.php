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
        $servicesPageObject = $ServicesPageManager->getServicesTitleandParagraph();
        foreach ($servicesPageObject as $serviceTitleAndParagraph) {
          ?>        
          <h1 class="text-white margin-top-bottom-40 text-size-60 text-line-height-1"><?php echo $serviceTitleAndParagraph->getTitle(); ?></h1>
          <p class="margin-bottom-0 text-size-16"><?php echo $serviceTitleAndParagraph->getParagraph(); ?><br>
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
        </div>  
        <?php
      }
      ?>
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
  </article>
</main>


<?php include 'footer.php'; ?>
