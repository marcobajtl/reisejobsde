<?php
/**
 * @var bool $boolSent
 */

?>

<div class="kontakt">
	<div class="container">
		<div class="form-container"
			 id="kntform">
			<form name="Form"
				  method="post">
				<div class="">
					<div class="alert alert-success successbox" id="successbox" role="alert">
						Die Nachricht wurde erfolgreich abgesendet.
					</div>
					<div class="alert alert-danger errorbox" id="errorbox" role="alert">
						Beim Senden der Nachricht ist ein Fehler aufgetreten.
					</div>

					<div>
						<label for="name">Name*</label>
						<input class="inputfield importantfield required"
							   type="text"
							   id="name"
							   name="firstname"
							   placeholder="Name"
							   required
						>
					</div>
					<div>
						<label for="nachname">Nachname*</label>
						<input class="inputfield importantfield required"
							   type="text"
							   id="nachname"
							   name="lastname"
							   placeholder="Nachname"
							   required>

					</div>
					<div>
						<label for="email">E-Mail Adresse*</label>
						<input class="inputfield importantfield required"
							   type="email"
							   id="email"
							   name="email"
							   placeholder="example@test.de"
							   required
						>
						<div>

							<label for="nachricht">Nachricht*</label>
							<textarea class="importantfield required"
									  name="nachricht"
									  id="nachricht"
									  placeholder="Hier Nachricht eingeben."
									  required
							></textarea>
						</div>
						<label for="honeypot"></label>
						<input type="text"
							   id="honeypot"
							   class="honeypot"
							   name="honeypot"
							   tabindex="-1"
							   autocomplete="off">
						<input type="hidden"
							   name="csrf_token"
							   id="csrf_token"
							   value="<?= $_SESSION['csrf_token'] ?>" />
						<div class="submitbtn">
							<input type="button"
								   id="submitbtn"
								   value="Absenden">
						</div>
						<p>Die mit einem * gekennzeichneten Felder sind Pflichtfelder.</p>
						<div id="debug">

						</div>
						<div class="modal fade"
							 id="exampleModal"
							 tabindex="-1"
							 aria-labelledby="exampleModalLabel"
							 aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"
											id="exampleModalLabel">Nachricht wird versendet..</h5>
										<button type="button"
												class="btn-close"
												data-bs-dismiss="modal"
												aria-label="Close"></button>
									</div>
									<div class="modal-body tg-center">
										<i class="fa-duotone fa-loader fa-pulse fa-5x "></i>
									</div>
								</div>
							</div>
						</div>
					</div>
			</form>
		</div>
	</div>
</div>
<script src="js/ajax/kontaktAjax.js"></script>