<?php
/**
 * @var array $arrBewerberList
 */
?>
<div class="container arbeitnehmer">
	<div class="row"></div>

	<div class="row">
		<div class="container">
			<div class="col-12 col-md-12">
                <?php foreach($arrBewerberList as $objBewerber): ?>
					<div class="row arbeitercontainer">
						<div class="col-12 col-md-4 imagecontainer">
							<div>
                                <?php if(file_exists("bilder/upload/bewerber/$objBewerber->intBewerberID.png")): ?>
									<img src="bilder/upload/bewerber/<?= $objBewerber->intBewerberID ?>.png"
										 alt="">
                                <?php else: ?>
									<img src="bilder/upload/bewerber/default.png"
										 alt="">
                                <?php endif ?>
							</div>
						</div>
						<div class="col-12 col-md-8 informationcontainer">
							<div class="row">
								<label for="name">Name:</label>
								<div class=""
									 id="name">
									<p><?= $objBewerber->strName ?> <?= $objBewerber->strNachname ?></p>
								</div>
							</div>
							<div class="row">
								<label for="email">Email:</label>
								<div class=""
									 id="email">
									<p><?= $objBewerber->strEmail ?></p>
								</div>
							</div>
							<div class="row">
								<label for="beschreibung">Kurzbeschreibung:</label>
								<div class=""
									 id="beschreibung">
									<p><?= $objBewerber->strBeschreibung ?></p>
								</div>
							</div>
							<div class="kontaktbtn"
								 id="<?= $objBewerber->intBewerberID ?>">
								<button>Kontakt</button>
							</div>
						</div>
					</div>
                <?php endforeach ?>

				<!-- Popup Formular -->
				<div class="popupform">
					<div id="id01"
						 class="modal">
						<!-- Modal Content -->
						<form class="modal-content animate"
							  action="arbeitnehmer"
							  method="post"
						>
							<input type="hidden"
								   name="csrf_token"
								   value="<?= $_SESSION['csrf_token'] ?>" />
							<div class="container">
								<label for="Nachricht"><b>Nachricht</b></label> <br>
								<textarea id="Nachricht"
										  name="Nachricht"></textarea>
							</div>
							<input type="hidden"
								   name="arbeitnehmerid"
								   id="arbeitnehmerid"
								   value="0">
							<div class="container"
								 style="background-color:#f1f1f1">
								<button type="submit"
										class="createbtn">Senden
								</button>
							</div>
						</form>
					</div>
				</div>
				<!-- End of Popup Formular -->

			</div>
		</div>
	</div>
</div>
<script src="js/ArbeitnehmerKontakt.js"></script>