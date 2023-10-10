<?php
include '../head.inc.php';


?>

<?php include 'header.php' ?>
<?php include 'modal-style.php' ?>


<?php include 'sidebar.php' ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

	<!-- Main Content -->
	<div id="content">

		<?php include 'topbar.php' ?>

		<!-- Begin Page Content -->
		<div class="container-fluid">
			<!-- SUCCESS MESSAGE -->
			<?php
			if (isset($_SESSION['successMessage'])) {
				?>
				<div id="successMessage" class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
					<strong>Yahoo!</strong><br><?php echo $_SESSION['successMessage'] ?>
				</div>
				<?php
				unset($_SESSION['successMessage']);
			}
			?>

			<!-- ERROR MESSAGE -->
			<?php
			if (isset($_SESSION['errorMessage'])) {
				?>
				<div class="alert alert-danger fade in alert-dismissible show">
					<strong>Oups!</strong><br><?php echo $_SESSION['errorMessage'] ?>
				</div>
				<?php
				unset($_SESSION['errorMessage']);
			}
			?>
			<!-- Page Heading -->
			<h1 class="h3 mb-2 text-gray-800">Contact</h1>


			<!-- TITLE -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary text-center">Title of the Contact Us Section</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="titleTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Title</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<!-- Display the title -->
								<?php
								$titleParagraphObject = $ContactUsManager->getTitleParagraph();
								$title = $titleParagraphObject->getTitle();
								?>
								<tr>
									<td><?php echo $title; ?></td>
									<td>
										<!-- Update title -->
										<button type="button" id="updateTitleButton" class="updateButton btn-primary btn-icon-split"
										data-id="<?php echo $titleParagraphObject->getId(); ?>"
										data-title="<?php echo $titleParagraphObject->getTitle(); ?>">
										<span class="icon text-white-50">
											<i class="fas fa-flag"></i>
										</span>
										<span class="text">Update title</span>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- CONTACT METHODS -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary text-center">Contact Methods</h6>
			</div>
			<div class="card-body">			
				<!-- Add a Contact Method -->
				<button type="button" id="addServiceButton" class="updateButton btn-success btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-flag"></i>
					</span>
					<span class="text">Add a Contact Method</span>
				</button>
				<br>
				<br>
				<div class="table-responsive">
					<table class="table table-bordered" id="servicesTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Order number</th>
								<th>Title</th>
								<th>Icon</th>
								<th>Line 1</th>
								<th>Line 2</th>
							</tr>
						</thead>
						<tbody>
							<!-- Display the contact methods -->
							<?php
							$allContactMethods = $ContactUsManager->getAllContactMethods();
							foreach ($allContactMethods as $contactMethod) {
								?>
								<tr>
									<td>
										<form method="post" action="../controllers/contact-us-controller.php">
											<input type="hidden" name="action" value="update_order_number_contact_method">
											<input type="hidden" name="id" value="<?php echo $contactMethod->getId(); ?>">
											<textarea name="order_number" style="width: 40px; height: 30px; resize: none;"><?php echo $contactMethod->getOrderNumber(); ?></textarea>
											<button type="submit" class="btn btn-primary btn-sm">Update</button>
										</form>
									</td>
									<td><?php echo $contactMethod->getTitle(); ?></td>
									<td><?php echo $contactMethod->getIcon(); ?></td>
									<td><?php echo $contactMethod->getLine1(); ?></td>
									<td><?php echo $contactMethod->getLine2(); ?></td>
									<td>
										<!-- Update  -->
										<button type="button" id="updateServiceButton" class="updateServiceButton btn-primary btn-icon-split mb-2" 
										data-id="<?php echo $contactMethod->getId(); ?>" 
										data-title="<?php echo $contactMethod->getTitle(); ?>" 
										data-icon="<?php echo $contactMethod->getIcon(); ?>"
										data-line1="<?php echo $contactMethod->getLine1(); ?>"
										data-line2="<?php echo $contactMethod->getLine2(); ?>"																
										>Update Contact Method</button>
										<!-- Delete  -->
										<?php
										if (isset($_SESSION['access_level'])) {
											$accessLevel = $_SESSION['access_level'];
											if ($accessLevel == 1) {
												?>
												<form method="post" action="../controllers/contact-us-controller.php" onsubmit="return confirmDelete();">
													<input type="hidden" name="action" value="delete_contact_method">
													<input type="hidden" name="id" value="<?php echo $contactMethod->getId(); ?>"> 
													<button type="submit" id="deleteServiceButton" class="deleteServiceButton btn-danger btn-icon-split">Delete Contact Method</button>
												</form>

											</td>
										</tr>
										<?php
									}
								}
								?>
								<!-- end of foreach loop -->
								<?php
							}
							?>
						</tbody>
					</table>
				</div>

				<!-- SOCIAL MEDIA -->
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary text-center">Social Media</h6>
					</div>

					<div class="card-body">
						<!-- Add a Social Media -->
						<button type="button" id="addSocialMediaButton" class="updateButton btn-success btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-flag"></i>
							</span>
							<span class="text">Add a Social Media</span>
						</button>
						<br>
						<br>
						<div class="table-responsive">
							<table class="table table-bordered" id="servicesTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Order number</th>
										<th>Title</th>
										<th>Icon</th>
										<th>Hyperlink</th>
									</tr>
								</thead>
								<tbody>
									<!-- Display the social media -->
									<?php
									$allSocialMedia = $ContactUsManager->getAllSocialMedia();
									foreach ($allSocialMedia as $socialMedia) {
										?>
										<tr>
											<td>
												<form method="post" action="../controllers/contact-us-controller.php">
													<input type="hidden" name="action" value="update_social_media_order_number">
													<input type="hidden" name="id" value="<?php echo $socialMedia->getId(); ?>">
													<textarea name="order_number" style="width: 40px; height: 30px; resize: none;"><?php echo $socialMedia->getOrderNumber(); ?></textarea>
													<button type="submit" class="btn btn-primary btn-sm">Update</button>
												</form>
											</td>
											<td><?php echo $socialMedia->getTitle(); ?></td>
											<td><?php echo $socialMedia->getIcon(); ?></td>
											<td><?php echo $socialMedia->getHyperlink(); ?></td>
											<td>
												<!-- Update  -->
												<button type="button" id="updateSocialMediaButton" class="updateSocialMediaButton btn-primary btn-icon-split mb-2" 
												data-id-social-media="<?php echo $socialMedia->getId(); ?>" 
												data-title-social-media="<?php echo $socialMedia->getTitle(); ?>" 
												data-icon-social-media="<?php echo $socialMedia->getIcon(); ?>"
												data-hyperlink-social-media="<?php echo $socialMedia->getHyperlink(); ?>"											
												>Update Social Media</button>
												<!-- Delete  -->
												<?php
												if (isset($_SESSION['access_level'])) {
													$accessLevel = $_SESSION['access_level'];
													if ($accessLevel == 1) {
														?>
														<form method="post" action="../controllers/contact-us-controller.php" onsubmit="return confirmDelete();">
															<input type="hidden" name="action" value="delete_social_media">
															<input type="hidden" name="id" value="<?php echo $socialMedia->getId(); ?>"> 
															<button type="submit" id="deleteSocialMediaButton" class="deleteServiceButton btn-danger btn-icon-split">Delete Social Media</button>
														</form>

													</td>
												</tr>
												<?php
											}
										}
										?>
										<!-- end of foreach loop -->
										<?php
									}
									?>
								</tbody>
							</table>
						</div>


						<!-- CONTACT FORM -->
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary text-center">Contact Form</h6>
							</div>

							<div class="card-body">
								<!-- Add a Social Media -->
								<button type="button" id="addContactFormButton" class="updateButton btn-success btn-icon-split">
									<span class="icon text-white-50">
										<i class="fas fa-flag"></i>
									</span>
									<span class="text">Add a Contact Form</span>
								</button>
								<br>
								<br>
								<div class="table-responsive">
									<table class="table table-bordered" id="servicesTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Order Number</th>
												<th>Input Type</th>
												<th>Name Input</th>
												<th>Place Holder</th>
												<th>Mandatory</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<!-- Display the Contact Form -->
											<?php
											$allContactForms = $ContactUsManager->getAllContactForms();
											foreach ($allContactForms as $contactForm) {
												?>
												<tr>
													<td>
														<form method="post" action="../controllers/contact-us-controller.php">
															<input type="hidden" name="action" value="update_order_number_contact_form">
															<input type="hidden" name="id" value="<?php echo $contactForm->getId(); ?>">
															<textarea name="order_number" style="width: 40px; height: 30px; resize: none;"><?php echo $contactForm->getOrderNumber(); ?></textarea>
															<button type="submit" class="btn btn-primary btn-sm">Update</button>
														</form>
													</td>
													<td><?php echo $contactForm->getInputType(); ?></td>
													<td><?php echo $contactForm->getInputName(); ?></td>
													<td><?php echo $contactForm->getPlaceHolder(); ?></td>
													<td><?php echo ($contactForm->getMandatory() == 1) ? 'Yes' : 'No'; ?></td>
													<td>
														<!-- Update  -->
														<button type="button" id="updateContactFormButton" class="updateContactFormButton btn-primary btn-icon-split mb-2" 
														data-id-contact-form="<?php echo $contactForm->getId(); ?>" 
														data-input-type-contact-form="<?php echo $contactForm->getInputType(); ?>" 
														data-input-name-contact-form="<?php echo $contactForm->getInputName(); ?>"
														data-placeholder-contact-form="<?php echo $contactForm->getPlaceHolder(); ?>"								
														data-mandatory-contact-form="<?php echo $contactForm->getMandatory(); ?>"
														data-order-number-contact-form="<?php echo $contactForm->getOrderNumber(); ?>"	
														>Update Contact Form</button>
														<!-- Delete  -->
														<?php
														if (isset($_SESSION['access_level'])) {
															$accessLevel = $_SESSION['access_level'];
															if ($accessLevel == 1) {
																?>
																<form method="post" action="../controllers/contact-us-controller.php" onsubmit="return confirmDelete();">
																	<input type="hidden" name="action" value="delete_contact_form">
																	<input type="hidden" name="id" value="<?php echo $contactForm->getId(); ?>"> 
																	<button type="submit" id="deleteSocialMediaButton" class="deleteServiceButton btn-danger btn-icon-split">Delete Contact Form</button>
																</form>

															</td>
														</tr>
														<?php
													}
												}
												?>
												<!-- end of foreach loop -->
												<?php
											}
											?>
										</tbody>
									</table>
								</div>


								<!-- OFFICE HOURS -->
								<div class="card shadow mb-4">
									<div class="card-header py-3">
										<h6 class="m-0 font-weight-bold text-primary text-center">Office Hours</h6>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered" id="servicesTable" width="100%" cellspacing="0">
												<thead>
													<tr>
														<th>Monday</th>
														<th>Tuesday</th>
														<th>Wednesday</th>
														<th>Thursday</th>
														<th>Thursday</th>
														<th>Saturday</th>
														<th>Sunday</th>
													</tr>
												</thead>
												<tbody>
													<!-- Display the office hours -->

													<?php
													$officeHoursObject = $ContactUsManager->getOfficeHours(); 

													if ($officeHoursObject !== null) {
														?>

														<tr>
															<td><?php echo $officeHoursObject->getMonday(); ?></td>
															<td><?php echo $officeHoursObject->getTuesday(); ?></td>
															<td><?php echo $officeHoursObject->getWednesday(); ?></td>
															<td><?php echo $officeHoursObject->getThursday(); ?></td>
															<td><?php echo $officeHoursObject->getFriday(); ?></td>
															<td><?php echo $officeHoursObject->getSaturday(); ?></td>
															<td><?php echo $officeHoursObject->getSunday(); ?></td>
															<td>
																<!-- Update  -->
																<button type="button" id="updateOfficeHoursButton" class="updateServiceButton btn-primary btn-icon-split mb-2" 
																data-id="<?php echo $officeHoursObject->getId(); ?>" 
																data-monday="<?php echo $officeHoursObject->getMonday(); ?>" 
																data-thuesday="<?php echo $officeHoursObject->getTuesday(); ?>"
																data-wednesday="<?php echo $officeHoursObject->getWednesday(); ?>"
																data-thursday="<?php echo $officeHoursObject->getThursday(); ?>"
																data-friday="<?php echo $officeHoursObject->getFriday(); ?>"
																data-saturday="<?php echo $officeHoursObject->getSaturday(); ?>"
																data-sunday="<?php echo $officeHoursObject->getSunday(); ?>"
																>
															Update Office Hours</button>
														</td>
													</tr>
													<!-- end of foreach loop -->
													<?php
												}
												?>
											</tbody>
										</table>
									</div>

									<!-- MODAL - Update the title of the Contact Us page -->
									<div id="updateTitleModal" class="modal">
										<div class="modal-content">
											<span class="close">&times;</span>
											<!-- Service title -->
											<h3 class="text-center">Update Title</h3>
											<form method="post" action="../controllers/contact-us-controller.php">
												<input type="hidden" id="titleMessageId" name="id" class="form-control">
												<label for="updateTitle"><strong>Title:</strong></label>
												<ul>
													<li>Title cannot be empty</li>
													<li>Title must be 50 characters or less</li>
												</ul>
												<input type="text" id="updateTitle" name="title" class="form-control">
												<br>
												<input type="hidden" name="action" value="update_title_contact_us">
												<button type="submit" class="btn btn-primary">Update Title</button>
											</form>
										</div>
									</div>

									<!-- MODAL - Update Contact Method-->
									<div id="updateServiceModal" class="modal">
										<div class="modal-content">
											<span class="close">&times;</span>
											<h3 class="text-center">Update Contact Method</h3>
											<form method="post" action="../controllers/contact-us-controller.php">
												<!-- Id -->
												<input type="hidden" id="updateIdContactMethod" name="id" class="form-control">
												<!-- Title -->
												<label for="serviceTitleModal"><strong>Title:</strong></label>
												<ul>
													<li>Title cannot be empty</li>
													<li>Title text must be 50 characters or less</li>
												</ul>
												<input id="updateTitleContactMethod" name="title" class="form-control">
												<br>
												<!-- Icon -->
												<label for="serviceIcon"><strong>Icon:</strong></label>
												<select id="updateIconContactMethod" name="icon" class="form-control">
													<option value="">Select Icon</option> 
													<option value="icon-sli-location-pin">Location Pin Icon</option>
													<option value="icon-sli-phone">Phone Icon</option>
													<option value="icon-sli-envelope">Enveloppe Icon</option>
													<option value="icon-sli-umbrella">Umbrella Icon</option>
													<option value="icon-sli-shield">Shield Icon</option>
													<option value="icon-sli-home">Home Icon</option>
													<option value="icon-sli-power">Power Icon</option>
													<option value="icon-sli-phone">Phone Icon</option>
													<option value="icon-sli-compass">Compass Icon</option>
													<option value="icon-sli-check">Check Icon</option>
													<option value="icon-sli-trophy">Trophy Icon</option>
													<option value="icon-sli-energy">Energy Icon</option>
													<option value="icon-sli-fire">Fire Icon</option>
													<option value="icon-sli-anchor">Anchor Icon</option>
													<option value="icon-sli-puzzle">Puzzle Icon</option>
												</select>
												<br>

												<!-- Line1 -->
												<label for="serviceTitleModal"><strong>Line 1:</strong></label>
												<ul>
													<li>Line 1 cannot be empty</li>
													<li>Line 1 text must be 50 characters or less</li>
												</ul>
												<input id="updateLine1ContactMethod" name="line1" class="form-control">
												<br>
												<!-- Line2 -->
												<label for="serviceTitleModal"><strong>Line 2:</strong></label>
												<ul>
													<li>Line 2 text must be 50 characters or less</li>
												</ul>
												<input id="updateLine2ContactMethod" name="line2" class="form-control">
												<br>
												<!-- Submit button -->
												<input type="hidden" name="action" value="update_contact_method">
												<button type="submit" class="btn btn-primary">Update Contact Method</button>
											</form>
										</div>
									</div>

									<!-- MODAL - Update Social Media-->
									<div id="updateSocialMediaModal" class="modal">
										<div class="modal-content">
											<span class="close">&times;</span>
											<h3 class="text-center">Update Social Media</h3>
											<form method="post" action="../controllers/contact-us-controller.php">
												<!-- Id -->
												<input type="hidden" id="updateIdSocialMedia" name="id" class="form-control">
												<!-- Title -->
												<label for="serviceTitleModal"><strong>Title:</strong></label>
												<ul>
													<li>Title cannot be empty</li>
													<li>Title text must be 50 characters or less</li>
												</ul>
												<input id="updateTitleSocialMedia" name="title" class="form-control">
												<br>
												<!-- Icon -->
												<label for="serviceIcon"><strong>Icon:</strong></label>
												<select id="updateIconSocialMedia" name="icon" class="form-control">
													<option value="">Select Icon</option> 
													<option value="icon-sli-social-facebook">Facebook Icon</option>
													<option value="icon-sli-social-instagram">Instagram Icon</option>
													<option value="icon-sli-social-linkedin">LinkeIn Icon</option>
													<option value="icon-sli-social-twitter">Twitter Icon</option>
													<option value="icon-sli-social-pinterest">Pinterest Icon</option>
													<option value="icon-sli-social-github">GitHub Icon</option>
													<option value="icon-sli-social-reddit">Reddit Icon</option>
													<option value="icon-sli-social-skype">Skype Icon</option>
													<option value="icon-sli-social-foursqare">FourSqare Icon</option>
													<option value="icon-sli-social-soundcloud">SoundCloud Icon</option>
													<option value="icon-sli-social-spotify">Spotify Icon</option>
													<option value="icon-sli-social-youtube">Youtube Icon</option>
													<option value="icon-sli-social-dropbox">DropBox Icon</option>	
												</select>
												<br>
												<!-- Hyperlink -->
												<label for="serviceTitleModal"><strong>Hyperlink:</strong></label>
												<ul>
													<li>Please insert the full url hyperlink (https://...)</li>
													<li>Hyperlink 1 cannot be empty</li>
													<li>Hyperlink text must be 250 characters or less</li>
												</ul>
												<input id="updateHyperlinkSocialMedia" name="hyperlink" class="form-control">
												<br>
												<!-- Submit button -->
												<input type="hidden" name="action" value="update_social_media">
												<button type="submit" class="btn btn-primary">Update Contact Method</button>
											</form>
										</div>
									</div>

									<!-- MODAL - Update Contact Form-->
									<div id="updateContactFormModal" class="modal">
										<div class="modal-content">
											<span class="close">&times;</span>
											<h3 class="text-center">Update Contact Form</h3>
											<form method="post" action="../controllers/contact-us-controller.php">
												<!-- Id -->
												<input type="hidden" id="updateIdContactForm" name="id" class="form-control">
												<!-- Input Type -->
												<label for="serviceIcon"><strong>Input Type:</strong></label>
												<select id="updateInputTypeContactForm" name="input_type" class="form-control">
													<option value="">Select Icon</option> 
													<option value="text">Text</option>
													<option value="textarea">Text area</option>														
												</select>
												<br>
												<!-- Input Name -->
												<label for="serviceTitleModal"><strong>Input Name:</strong></label>
												<ul>
													<li>Input name must be camelcase (ex: First name = firstName)</li>
													<li>Input name cannot be empty</li>
													<li>Input name must be 50 characters or less</li>
												</ul>
												<input id="updateInputNameContactForm" name="input_name" class="form-control">
												<br>
												<!-- Placeholder -->
												<label for="serviceTitleModal"><strong>Placeholder:</strong></label>
												<ul>
													<li>Placeholder cannot be empty</li>
													<li>Placeholder must be 50 characters or less</li>
												</ul>
												<input id="updatePlaceholderContactForm" name="place_holder" class="form-control">
												<br>
												<!-- Mandatory -->
												<label for="serviceIcon"><strong>Mandatory:</strong></label>
												<select id="updateMandatoryContactForm" name="mandatory" class="form-control">
													<option value="">Yes or No? (By default = No)</option> 
													<option value="1">Yes</option>
													<option value="0">No</option>														
												</select>
												<br>				
												<!-- Order number -->
												<label for="serviceTitleModal"><strong>Order number:</strong></label>
												<ul>
													<li>Order number must be between 1 and 100</li>
												</ul>
												<input id="updateOrderNumberContactForm" name="order_number" class="form-control">
												<br>         
												<!-- Submit button -->
												<input type="hidden" name="action" value="update_contact_form">
												<button type="submit" class="btn btn-primary">Update Contact Form</button>
											</form>
										</div>
									</div>


									<!-- MODAL - Add a Contact Method-->
									<div id="addServiceModal" class="modal">
										<div class="modal-content">
											<span class="close">&times;</span>
											<h3 class="text-center">Add a Contact Method</h3>
											<form method="post" action="../controllers/contact-us-controller.php">
												<!-- Title -->
												<label for="serviceTitleModal"><strong>Title:</strong></label>
												<ul>
													<li>Title cannot be empty</li>
													<li>Title text must be 50 characters or less</li>
												</ul>
												<input id="addTitleContactMethod" name="title" class="form-control">
												<br>
												<!-- Icon -->
												<label for="serviceIcon"><strong>Icon:</strong></label>
												<select id="serviceIcon" name="icon" class="form-control">
													<option value="">Select Icon</option> 
													<option value="icon-sli-location-pin">Location Pin Icon</option>
													<option value="icon-sli-phone">Phone Icon</option>
													<option value="icon-sli-envelope">Enveloppe Icon</option>
													<option value="icon-sli-umbrella">Umbrella Icon</option>
													<option value="icon-sli-shield">Shield Icon</option>
													<option value="icon-sli-home">Home Icon</option>
													<option value="icon-sli-power">Power Icon</option>
													<option value="icon-sli-phone">Phone Icon</option>
													<option value="icon-sli-compass">Compass Icon</option>
													<option value="icon-sli-check">Check Icon</option>
													<option value="icon-sli-trophy">Trophy Icon</option>
													<option value="icon-sli-energy">Energy Icon</option>
													<option value="icon-sli-fire">Fire Icon</option>
													<option value="icon-sli-anchor">Anchor Icon</option>
													<option value="icon-sli-puzzle">Puzzle Icon</option>
												</select>
												<br>
												<!-- Line1 -->
												<label for="serviceTitleModal"><strong>Line 1:</strong></label>
												<ul>
													<li>Line 1 cannot be empty</li>
													<li>Line 1 text must be 50 characters or less</li>
												</ul>
												<input id="addLine1ContactMethod" name="line1" class="form-control">
												<br>
												<!-- Line2 -->
												<label for="serviceTitleModal"><strong>Line 2:</strong></label>
												<ul>
													<li>Line 2 text must be 50 characters or less</li>
												</ul>
												<input id="addLine2ContactMethod" name="line2" class="form-control">
												<br>
												<!-- Order number -->
												<label for="serviceTitleModal"><strong>Order number:</strong></label>
												<ul>
													<li>Order number must be between 1 and 100</li>
												</ul>
												<input id="addLine2ContactMethod" name="order_number" class="form-control">
												<br>         
												<!-- Submit button -->
												<input type="hidden" name="action" value="add_contact_method">
												<button type="submit" class="btn btn-primary">Add Service</button>
											</form>
										</div>
									</div>


									<!-- MODAL - Add a Social Media-->
									<div id="addSocialMediaModal" class="modal">
										<div class="modal-content">
											<span class="close">&times;</span>
											<h3 class="text-center">Add a Social Media</h3>
											<form method="post" action="../controllers/contact-us-controller.php">
												<!-- Title -->
												<label for="serviceTitleModal"><strong>Title:</strong></label>
												<ul>
													<li>Title cannot be empty</li>
													<li>Title text must be 50 characters or less</li>
												</ul>
												<input id="addSocialMediaTitle" name="title" class="form-control">
												<br>
												<!-- Icon -->
												<label for="serviceIcon"><strong>Icon:</strong></label>
												<select id="addSocialMediaIcon" name="icon" class="form-control">
													<option value="">Select Icon</option> 
													<option value="icon-sli-social-facebook">Facebook Icon</option>
													<option value="icon-sli-social-instagram">Instagram Icon</option>
													<option value="icon-sli-social-linkedin">LinkeIn Icon</option>
													<option value="icon-sli-social-twitter">Twitter Icon</option>
													<option value="icon-sli-social-pinterest">Pinterest Icon</option>
													<option value="icon-sli-social-github">GitHub Icon</option>
													<option value="icon-sli-social-reddit">Reddit Icon</option>
													<option value="icon-sli-social-skype">Skype Icon</option>
													<option value="icon-sli-social-foursqare">FourSqare Icon</option>
													<option value="icon-sli-social-soundcloud">SoundCloud Icon</option>
													<option value="icon-sli-social-spotify">Spotify Icon</option>
													<option value="icon-sli-social-youtube">Youtube Icon</option>
													<option value="icon-sli-social-dropbox">DropBox Icon</option>							
												</select>
												<br>
												<!-- Hyperlink -->
												<label for="serviceTitleModal"><strong>Hyperlink:</strong></label>
												<ul>
													<li>Please insert the full url hyperlink (https://...)</li>
													<li>Hyperlink 1 cannot be empty</li>
													<li>Hyperlink text must be 250 characters or less</li>
												</ul>
												<input id="addHyperlinkSocialMedia" name="hyperlink" class="form-control">
												<br>								
												<!-- Order number -->
												<label for="serviceTitleModal"><strong>Order number:</strong></label>
												<ul>
													<li>Order number must be between 1 and 100</li>
												</ul>
												<input id="addOrderNumberSocialMedia" name="order_number" class="form-control">
												<br>         
												<!-- Submit button -->
												<input type="hidden" name="action" value="add_social_media">
												<button type="submit" class="btn btn-primary">Add Social Media</button>
											</form>
										</div>
									</div>

									<!-- MODAL - Add a Contact Form-->
									<div id="addContactFormModal" class="modal">
										<div class="modal-content">
											<span class="close">&times;</span>
											<h3 class="text-center">Add a Contact Form</h3>
											<form method="post" action="../controllers/contact-us-controller.php">
												<!-- Input Type -->
												<label for="serviceIcon"><strong>Input Type:</strong></label>
												<select id="addSocialMediaIcon" name="input_type" class="form-control">
													<option value="">Select Input Type</option> 
													<option value="text">Text</option>
													<option value="textarea">Text area</option>														
												</select>
												<br>
												<!-- Input Name -->
												<label for="serviceTitleModal"><strong>Input Name:</strong></label>
												<ul>
													<li>Input name must be camelcase (ex: First name = firstName)</li>
													<li>Input name cannot be empty</li>
													<li>Input name must be 50 characters or less</li>
												</ul>
												<input id="addSocialMediaTitle" name="input_name" class="form-control">
												<br>
												<!-- Placeholder -->
												<label for="serviceTitleModal"><strong>Placeholder:</strong></label>
												<ul>
													<li>Placeholder cannot be empty</li>
													<li>Placeholder must be 50 characters or less</li>
												</ul>
												<input id="addSocialMediaTitle" name="place_holder" class="form-control">
												<br>
												<!-- Mandatory -->
												<label for="serviceIcon"><strong>Mandatory:</strong></label>
												<select id="addSocialMediaIcon" name="mandatory" class="form-control">
													<option value="">Yes or No? (By default = No)</option> 
													<option value="1">Yes</option>
													<option value="0">No</option>														
												</select>
												<br>				
												<!-- Order number -->
												<label for="serviceTitleModal"><strong>Order number:</strong></label>
												<ul>
													<li>Order number must be between 1 and 100</li>
												</ul>
												<input id="addOrderNumberSocialMedia" name="order_number" class="form-control">
												<br>         
												<!-- Submit button -->
												<input type="hidden" name="action" value="add_contact_form">
												<button type="submit" class="btn btn-primary">Add Contact Form</button>
											</form>
										</div>
									</div>

									<!-- MODAL - Update Office Hours-->
									<div id="updateOfficeHoursModal" class="modal">
										<div class="modal-content">
											<span class="close">&times;</span>
											<h3 class="text-center">Update Office Hours</h3>
											<form method="post" action="../controllers/contact-us-controller.php">
												<!-- Id -->
												<input type="hidden" id="updateOfficeHoursId" name="id" class="form-control">
												<!-- Monday -->
												<label for="serviceTitleModal"><strong>Monday Hours:</strong></label>
												<ul>
													<li>Monday hours cannot be empty</li>
													<li>Monday hours must be 50 characters or less</li>
												</ul>
												<input id="monday" name="monday" class="form-control">
												<br>
												<!-- Tuesday -->
												<label for="serviceTitleModal"><strong>Tuesday Hours:</strong></label>
												<ul>
													<li>Tuesday Hours cannot be empty</li>
													<li>Tuesday Hours text must be 50 characters or less</li>
												</ul>
												<input id="thuesday" name="tuesday" class="form-control">
												<br>

												<!-- Wednesday -->
												<label for="serviceTitleModal"><strong>Wednesday Hours:</strong></label>
												<ul>
													<li>Wednesday Hours cannot be empty</li>
													<li>Wednesday Hours text must be 50 characters or less</li>
												</ul>
												<input id="wednesday" name="wednesday" class="form-control">
												<br>
												<!-- Thursday -->
												<label for="serviceTitleModal"><strong>Thursday Hours:</strong></label>
												<ul>
													<li>Thursday Hours cannot be empty</li>
													<li>Thursday Hours text must be 50 characters or less</li>
												</ul>
												<input id="thursday" name="thursday" class="form-control">
												<br>
												<!-- Friday -->
												<label for="serviceTitleModal"><strong>Friday Hours:</strong></label>
												<ul>
													<li>Friday Hours cannot be empty</li>
													<li>Friday Hours text must be 50 characters or less</li>
												</ul>
												<input id="friday" name="friday" class="form-control">
												<br>
												<!-- Saturday -->
												<label for="serviceTitleModal"><strong>Saturday Hours:</strong></label>
												<ul>
													<li>Saturday Hours cannot be empty</li>
													<li>Saturday Hours text must be 50 characters or less</li>
												</ul>
												<input id="saturday" name="saturday" class="form-control">
												<br>
												<!-- Sunday -->
												<label for="serviceTitleModal"><strong>Sunday Hours:</strong></label>
												<ul>
													<li>Sunday Hours cannot be empty</li>
													<li>Sunday Hours must be 50 characters or less</li>
												</ul>
												<input id="sunday" name="sunday" class="form-control">
												<br>
												<!-- Submit button -->
												<input type="hidden" name="action" value="update_office_hours">
												<button type="submit" class="btn btn-primary">Update Office Hours</button>
											</form>
										</div>
									</div>

									<script type="text/javascript">

										function confirmDelete() {
											return confirm("Are you sure you want to delete the selected Item?");
										}

// Buttons
										var updateTitleButton = document.getElementById("updateTitleButton");
var updateServicesButtons = document.querySelectorAll(".updateServiceButton"); // Targeting the class instead of the id since an id must be unique
var addServiceButton = document.getElementById("addServiceButton");
var updateOfficeHoursButton = document.getElementById("updateOfficeHoursButton");
var addSocialMediaButton = document.getElementById("addSocialMediaButton");
var updateSocialMediaButtons = document.querySelectorAll(".updateSocialMediaButton");
var addContactFormButton = document.getElementById("addContactFormButton");
var updateContactFormButtons = document.querySelectorAll(".updateContactFormButton");

// Linking to the modal
var updateTitleModalElement = document.getElementById("updateTitleModal");
var updateServicesModalElement = document.getElementById("updateServiceModal");
var addServiceModalElement = document.getElementById("addServiceModal");
var updateOfficeHoursModalElement = document.getElementById('updateOfficeHoursModal');
var addSocialMediaModalElement = document.getElementById("addSocialMediaModal");
var updateSocialMediaModalElement = document.getElementById('updateSocialMediaModal');
var addContactFormModalElement = document.getElementById("addContactFormModal");
var updateContactFormModalElement = document.getElementById("updateContactFormModal");

function closeModal(modal) {
	modal.style.display = "none";
}

// Update Title section
updateTitleButton.addEventListener("click", function() {
	var title = updateTitleButton.getAttribute("data-title");
	var id = updateTitleButton.getAttribute("data-id");

	document.getElementById("updateTitle").value = title;
	document.getElementById("titleMessageId").value = id;

	updateTitleModalElement.style.display = "block";
});


// Update Contact Method
updateServicesButtons.forEach(function(button) {
	button.addEventListener("click", function() {
		var id = button.getAttribute("data-id");
		var title = button.getAttribute("data-title");
		var icon = button.getAttribute("data-icon");
		var line1 = button.getAttribute("data-line1");
		var line2 = button.getAttribute("data-line2");

		document.getElementById("updateIdContactMethod").value = id;
		document.getElementById("updateTitleContactMethod").value = title;
		document.getElementById("updateIconContactMethod").value = icon;		
		document.getElementById("updateLine1ContactMethod").value = line1;
		document.getElementById("updateLine2ContactMethod").value = line2;

		updateServicesModalElement.style.display = "block";
	});
});

// Update Social Media
updateSocialMediaButtons.forEach(function(button) {
	button.addEventListener("click", function() {
		var id = button.getAttribute("data-id-social-media");
		var title = button.getAttribute("data-title-social-media");
		var icon = button.getAttribute("data-icon-social-media");
		var hyperlink = button.getAttribute("data-hyperlink-social-media");
		

		document.getElementById("updateIdSocialMedia").value = id;
		document.getElementById("updateTitleSocialMedia").value = title;
		document.getElementById("updateIconSocialMedia").value = icon;		
		document.getElementById("updateHyperlinkSocialMedia").value = hyperlink;
		

		updateSocialMediaModalElement.style.display = "block";
	});
});

// Add Contact Method
addServiceButton.addEventListener("click", function() {
	addServiceModalElement.style.display = "block";
});

// Add Social Media
addSocialMediaButton.addEventListener("click", function() {
	addSocialMediaModalElement.style.display = "block";
});

// Add Contact Form
addContactFormButton.addEventListener("click", function() {
	addContactFormModalElement.style.display = "block";
});


// Update Office Hours
updateOfficeHoursButton.addEventListener("click", function() {
    // Fetch data attributes from the button
	var id = updateOfficeHoursButton.getAttribute("data-id");
	var monday = updateOfficeHoursButton.getAttribute("data-monday");
	var tuesday = updateOfficeHoursButton.getAttribute("data-thuesday");
	var wednesday = updateOfficeHoursButton.getAttribute("data-wednesday");
	var thursday = updateOfficeHoursButton.getAttribute("data-thursday");
	var friday = updateOfficeHoursButton.getAttribute("data-friday");
	var saturday = updateOfficeHoursButton.getAttribute("data-saturday");
	var sunday = updateOfficeHoursButton.getAttribute("data-sunday");

    // Populate the modal's input fields with fetched data
	document.getElementById("updateOfficeHoursId").value = id;
	document.getElementById("monday").value = monday;
	document.getElementById("thuesday").value = tuesday;
	document.getElementById("wednesday").value = wednesday;
	document.getElementById("thursday").value = thursday;
	document.getElementById("friday").value = friday;
	document.getElementById("saturday").value = saturday;
	document.getElementById("sunday").value = sunday;

    // Display the modal
	updateOfficeHoursModalElement.style.display = "block";
});

// Update Contact Form
updateContactFormButtons.forEach(function(button) {
	button.addEventListener("click", function() {
		var id = button.getAttribute("data-id-contact-form");
		var inputType = button.getAttribute("data-input-type-contact-form");
		var inputName = button.getAttribute("data-input-name-contact-form");
		var placeholder = button.getAttribute("data-placeholder-contact-form");
		var mandatory = button.getAttribute("data-mandatory-contact-form");
		var orderNumber = button.getAttribute("data-order-number-contact-form")

		document.getElementById("updateIdContactForm").value = id;
		document.getElementById("updateInputTypeContactForm").value = inputType;
		document.getElementById("updateInputNameContactForm").value = inputName;
		document.getElementById("updatePlaceholderContactForm").value = placeholder;
		document.getElementById("updateMandatoryContactForm").value = mandatory;
		document.getElementById("updateOrderNumberContactForm").value = orderNumber;
		
		updateContactFormModalElement.style.display = "block";
	});
});


// Closing the modal
var closeButtons = document.getElementsByClassName("close");
for (var i = 0; i < closeButtons.length; i++) {
	closeButtons[i].addEventListener("click", function() {
		closeModal(updateTitleModalElement);
		closeModal(updateServicesModalElement);
		closeModal(addServiceModal); 
		closeModal(updateOfficeHoursModalElement);
		closeModal(addSocialMediaModalElement);
		closeModal(updateSocialMediaModalElement);
		closeModal(addContactFormModalElement);
		closeModal(updateContactFormModalElement);	
	});
}

</script>
</div>
</div>


</div>
<!-- End of Main Content -->
</div>

<?php include 'footer.php';