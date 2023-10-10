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
        <h1 class="text-white margin-top-bottom-40 text-size-60 text-line-height-1">
          <?php
          $titleParagraphObject = $ContactUsManager->getTitleParagraph();
          $title = $titleParagraphObject->getTitle();
          echo $title;
          ?>
        </h1>
        <p class="margin-bottom-0 text-size-16">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.<br>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
      </div>  
    </header>

    <!-- CONTACT METHODS TRADITIONAL-->
    <div class="section background-white">
      <h2 class="text-center" style="font-size: 36px;">Traditional</h2>
      <br>
      <div class="line">
        <div class="margin">
          <?php
          $allContactMethods = $ContactUsManager->getAllContactMethods();
          foreach ($allContactMethods as $contactMethod) {
            ?>
            <div class="s-12 m-12 l-4 margin-m-bottom">
              <div class="">
                <div class="float-left hide-s">
                  <i class="<?php echo $contactMethod->getIcon(); ?> icon3x text-primary"></i>
                </div>
                <div class="margin-left-70 margin-s-left-0 margin-bottom">
                  <h3 class="margin-bottom-0"><?php echo $contactMethod->getTitle(); ?></h3>
                  <p><?php echo $contactMethod->getLine1(); ?><br>
                    <?php echo $contactMethod->getLine2(); ?>
                  </p>
                </div>
              </div>
            </div>
            <?php
      } // End of foreach loop
      ?>
    </div>
  </div>
</div>

<!-- CONTACT METHODS SOCIAL MEDIA-->
<div class="section background-white">
  <h2 class="text-center" style="font-size: 36px;">Social Media</h2>
  <br>
  <div class="line margin-bottom-60">
    <div class="margin">
      <?php
      $allSocialMedia = $ContactUsManager->getAllSocialMedia();
      foreach ($allSocialMedia as $socialMedia) {
        ?>
        <div class="s-12 m-12 l-4 margin-m-bottom">
          <div class="">
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
              <h3 style="text-align: center;"><?php echo $socialMedia->getTitle(); ?></h3> 
              <?php 
              $hyperlink = $socialMedia->getHyperlink();
              if (!preg_match("~^(?:f|ht)tps?://~i", $hyperlink)) {
                $hyperlink = "https://" . $hyperlink;
              }
              ?>
              <a href="<?php echo $hyperlink; ?>" target="_blank"><i style="text-align: center;" class="<?php echo $socialMedia->getIcon(); ?> icon3x text-primary"></i></a>

            </div>
            <div class="margin-left-70 margin-s-left-0 margin-bottom">
              <p><br></p>
            </div>
          </div>
        </div>
        <?php
      } // End of foreach loop
      ?>
    </div>
  </div>
</div>


<!-- Contact Form -->
<div class="line">
  <div class="margin"> 
    <div class="s-12 m-12 l-6">
      <h2 class="margin-bottom-10">Leave Message</h2>
      <form name="contactForm" class="customform" method="post">
        <!-- Input -->
        <div class="s-12"> 
          <?php
          $allContactForms = $ContactUsManager->getAllContactForms();
          foreach ($allContactForms as $contactForm) {
            if ($contactForm->getInputType() == 'text') {
              ?>
              <input name="<?= $contactForm->getInputName(); ?>" class="<?= $contactForm->getMandatory() == 1 ? 'required' : ''; ?>" placeholder="<?= $contactForm->getPlaceHolder(); ?>" title="<?= $contactForm->getInputName(); ?>" type="text" <?= $contactForm->getMandatory() ? 'required' : ''; ?> />
              <?php
            }
          }
          ?>
        </div>
        <!-- Textarea -->
        <div class="s-12">
          <?php
          foreach ($allContactForms as $contactForm) {
            if ($contactForm->getInputType() == 'textarea') {
              ?>
              <textarea name="<?= $contactForm->getInputName(); ?>" class="<?= $contactForm->getMandatory() == 1 ? 'required' : ''; ?>" placeholder="<?= $contactForm->getPlaceHolder(); ?>" rows="4" <?= $contactForm->getMandatory() ? 'required' : ''; ?>></textarea>
              <?php
            }
          }
          ?>
        </div>
        <div class="s-12"><button class="s-12 submit-form button background-primary text-white" type="submit">Submit Button</button></div>
        <br>
      </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Build the email body content dynamically
      $emailBody = "Contact Form Data:\n";
      foreach ($_POST as $key => $value) {
        $inputName = $key;
        $inputValue = $value ?? 'N/A';
        $emailBody .= "{$inputName}: {$inputValue}\n";
      }

    // Send email using PHP's built-in mail() function
      $to = 'louis_admin@gmail.com';
      $subject = 'Contact Form Submission';
      $headers = 'From: your_email@example.com' . "\r\n" .
      'Reply-To: your_email@example.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

      if (mail($to, $subject, $emailBody, $headers)) {
        echo "Email sent successfully!";
      } else {
        echo "Failed to send email.";
      }
    }
    ?>


    <!-- Office Hours -->
    <div class="s-12 m-12 l-4">
      <h2 class="margin-bottom-10">Office Hours</h2>
      <div class="s-6">
        <p class="text-size-16">
          Monday<br>
          Tuesday<br>
          Wednesday<br>
          Thursday<br>
          Friday<br>
          Saturday<br>
          Sunday
        </p>
      </div>
      <div class="s-6">
        <p class="text-size-16 text-strong">
          <?php
          $officeHoursObject = $ContactUsManager->getOfficeHours();

          echo $officeHoursObject->getMonday() . '<br>';
          echo $officeHoursObject->getTuesday() . '<br>';
          echo $officeHoursObject->getWednesday() . '<br>';
          echo $officeHoursObject->getThursday() . '<br>';
          echo $officeHoursObject->getFriday() . '<br>';
          echo $officeHoursObject->getSaturday() . '<br>';
          echo $officeHoursObject->getSunday();
          ?>

        </p>
        <br>
      </div>
    </div>
  </div>    
</div>  
</div> 
</article>
</main>



<?php include 'footer.php'; ?>