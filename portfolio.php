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
        $portfolioTitleAndParagraph = $PortfolioPageManager->getPortfolioPageTitleAndParagraph();
        foreach ($portfolioTitleAndParagraph as $titleAndParagraph) {
          ?>        
          <h1 class="text-white margin-top-bottom-40 text-size-60 text-line-height-1"><?php echo $titleAndParagraph->getTitle(); ?></h1>
          <p class="margin-bottom-0 text-size-16"><?php echo $titleAndParagraph->getParagraph();  ?></p>
        </div>
        <?php
      }
      ?>  
    </header>

<!-- PORTFOLIO -->
<!-- isVisible -->
<?php
$section = 'Portfolio';
$sliderVisibilityObject = $VisibilityManager->getVisibilityBySection($section);
$sliderVisibility = $sliderVisibilityObject->getIsVisible();

if ($sliderVisibility == 1) {
?>
  <section class="section-top-padding full-width">
    <h2 class="text-size-50 text-m-size-40 text-center">Portfolio</h2>
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
  </article>
</main>



<?php include 'footer.php'; ?>