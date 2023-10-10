    <!-- FOOTER -->
    <?php
    $footer = $FooterManager->getFooter();

    ?>
     <footer>
      <section class="padding background-dark full-width">
        <div class="s-12 l-6">
          <p class="text-size-12"><?php echo $footer->getCopyright(); ?>, <?php echo $footer->getDesignCompany(); ?></p>
          <p class="text-size-12"><?php echo $footer->getLegalMessage(); ?></p>
        </div>
        <div class="s-12 l-6">
          <a class="right text-size-12" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding<br> by Major Software</a>
        </div>
      </section>
    </footer>
    <script type="text/javascript" src="js/responsee.js"></script>
    <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="js/template-scripts.js"></script>
  </body>
  </html>