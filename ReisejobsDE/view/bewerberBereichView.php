<?php
/** @var $arrJobList
 * @var $arrUnternehmenList
 * @var $arrBewerberData
 *
 */

$_SESSION['csrf_token'] = hash("SHA256", uniqid('', true));

?>

<div class="container bewerberbereich">

	<div class="row siteheader">
		<p>Benutzerbereich für Bewerber</p>
	</div>

    <?php if(isset($strBoxMessage) && $strBoxMessage !== ""): ?>
		<div class="messagebox">
            <?= $strBoxMessage ?>
		</div>
    <?php endif ?>

	<!-- Aktuelle Stellenanzeigen -->
	<div class="row">
		<div class="col-12 col-md-9 mainsection">
			<div class="row">
				<div class="jobheader">
					<div class="row justify-content-center quicknav">
						<div class="col-5 col-lg-3 active align-self-center"
							 id="favjobs">Gemerkte Jobs
						</div>
						<div class="col-5 col-lg-3 align-self-center"
							 id="quickkontakt">Kontakt
						</div>
					</div>
				</div>
			</div>
			<div class="jobcontainer jobs"
				 id="jobcontainer">
                <?php foreach($arrJobList as $objJob): ?>
					<div class="jobcontainer">
						<div class="col-12 col-lg-12">
							<div class="row pos-rel">
								<div class="col-12 col-lg-3 jobimagesection">
                                    <?php if(file_exists("bilder/upload/profile/$objJob->intFKUnternehmenID.png")): ?>
										<img src="bilder/upload/profile/<?= $objJob->intFKUnternehmenID ?>.png"
											 alt="">
                                    <?php else: ?>
										<img src="bilder/upload/profile/default.png"
											 alt="">
                                    <?php endif ?>
								</div>
								<div class="col-12 col-lg-5 jobtextsection">
									<div class="textbox">
										<div class="row jobtitel"><?= $objJob->strTitel ?></div>
										<div class="row jobunternehmen"><?= $objJob->strName ?></div>
										<div class="row jobstandort">
											<span class="nopad"><i class="fa-light fa-map-location"></i> <?= $objJob->intPostleitzahl ?> <?= $objJob->strStandort ?>
											</span>
										</div>
										<div class="row jobbeschreibung"><?= $objJob->strBeschreibung ?></div>
									</div>
								</div>
								<div class="col-12 col-lg-4 ">
									<div class="jobctasection">
										<button class="bewerbenbtn"><a href="benutzerbereich?bewerben=<?= $objJob->intFKUnternehmenID ?>">Jetzt Bewerben</a></button>
										<button class="favbtn redicon"
												id="<?= $objJob->intID ?>"><i class="fa-duotone fa-heart fa-xl"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
                <?php endforeach; ?>
			</div>
			<div id="quickkontaktarea"
				 class="hidden">
				<div class="kontaktform">
					<form action="benutzerbereich"
						  method="post">
						<label for="unternehmen">Unternehmen</label>
						<select id="unternehmen"
								name="unternehmen">
							<option value="<?= $arrBewerberData->strEmail ?>"
									selected
									disabled>-- Bitte Auswählen --
							</option>
                            <?php foreach($arrUnternehmenList as $arrUnternehmen): ?>
								<option value="<?= $arrUnternehmen[0] ?>"

                                    <?php if(isset($_GET['bewerben']) && (int)$_GET['bewerben'] === (int)$arrUnternehmen[0]): ?>
										selected
                                    <?php endif ?>


								><?= $arrUnternehmen[1] ?></option>
                            <?php endforeach; ?>
						</select>

						<label for="vorname">Vorname</label>
						<input type="text"
							   id="vorname"
							   name="vorname"
							   value="<?= $arrBewerberData->strName ?>"
							   placeholder="Vorname">

						<label for="nachname">Nachname</label>
						<input type="text"
							   id="nachname"
							   name="nachname"
							   value="<?= $arrBewerberData->strNachname ?>"
							   placeholder="Nachname">

						<label for="email">E-Mail</label>
						<input type="text"
							   id="email"
							   name="email"
							   value="<?= $arrBewerberData->strEmail ?>"
							   placeholder="E-Mail">

						<label for="nachricht">Nachricht</label>
						<textarea id="nachricht"
								  name="nachricht"
								  placeholder="Deine Nachricht"></textarea>
						<input type="hidden"
							   name="csrf_token"
							   value="<?= $_SESSION['csrf_token'] ?>">
						<input type="submit"
							   class="submitbtn"
							   value="Submit">

					</form>
				</div>
			</div>
		</div>
		<!-- End of Stellenanzeigen -->

		<!-- Unternehmens Sidebar -->
		<div class="col-12 col-md-3 sidebar">
			<div>
				<form action="benutzerbereich"
					  method="post"
					  enctype="multipart/form-data">
					<div class="row unternehmensheader">
						<p> Dein Profil:</p>
					</div>
					<div class="row logo"><!--suppress DuplicatedCode -->
						<img src="bilder/upload/bewerber/<?= $arrBewerberData->intBewerberID ?>.png"
							 alt="">
						<input type="file"
							   name="fileToUpload"
							   id="uploadbtn"
							   class="hidden"
							   data-buttonText="Your label here.">
					</div>
					<br>
					<div class="row vorname">
						<p class="nomrg">Vorname:</p>
						<p id="sidevorname"><?= $arrBewerberData->strName ?></p>
					</div>
					<div class="row nachname">
						<p class="nomrg">Nachname:</p>
						<p id="sidenachname"><?= $arrBewerberData->strNachname ?></p>
					</div>
					<div class="row email">
						<p class="nomrg">E-Mail:</p>
						<p id="sideemail"><?= $arrBewerberData->strEmail ?></p>
					</div>
					<div class="row beschreibung">
						<p class="nomrg">Kurzbeschreibung:</p>
						<p id="sidebeschreibung"><?= $arrBewerberData->strBeschreibung ?></p>
					</div>
					<input type="hidden"
						   name="csrf_token"
						   value="<?= $_SESSION['csrf_token'] ?>">
					<div class="changebtn">
						<input type="button"
							   id="changebtn"
							   value="Edit">
					</div>
				</form>
			</div>
		</div>
		<!-- End of Unternehmens Sidebar -->
	</div>
</div>
<script src="js/BewerberBenutzerbereich.js"></script>
<script src="js/ajax/favorizejobs.js"></script>