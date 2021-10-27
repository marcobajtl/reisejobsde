<?php
/** @var $objUnternehmensDaten */
?>

<div class="container benutzerinterface">
	<div class="row siteheader">
		<p>Benutzerbereich für Unternehmen</p>
	</div>

	<!-- Aktuelle Stellenanzeigen -->
	<div class="row">
		<div class="col-12 col-md-9 mainsection">
			<div class="row">
				<div class="jobheader">
					<p>Deine Aktuellen Jobanzeigen</p>
					<div class="addbtn">
						<a id="addbtn">+</a>
					</div>
				</div>
			</div>
			<div class="container">
                <?php foreach($objUnternehmensDaten->arrJobs as $job): ?>
					<form action="userinterface"
						  method="post"
						  id="$job->intJobID">
						<div class="row jobcontainer d-flex">
							<div class="col-12 col-md-9 jobname justify-content-center">
								<p>Jobtitel: <?= $job->strJobName ?></p>
							</div>
							<div class="col-12 col-md-3 jobort justify-content-center">
								<p>Standort: <?= $job->strJobOrt ?></p>
							</div>
							<div class="row">
								<div class="col-12 col-md-12 jobbeschreibung">
									<p><?= $job->strJobBeschreibung ?>
									</p>
									<div>
										<button name="delete"
												class="deletebtn"
												value="<?= $job->intJobID ?>"
												type="submit">x
										</button>
									</div>
									<div>
										<button name="edit"
												class="editbtn"
												value=""
												type="button"><a href="userinterface/editpost?ID=<?= $job->intJobID ?>">&#9998;</a>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
                <?php endforeach ?>
			</div>
		</div>
		<!-- End of Stellenanzeigen -->

		<!-- Unternehmens Sidebar -->
		<div class="col-12 col-md-3 sidebar">
			<div>
				<form action="userinterface"
					  method="post"
					  enctype="multipart/form-data">
					<div class="row unternehmensheader">
						<p> Dein Unternehmen:</p>
					</div>
					<div class="row logo"><img src="bilder/upload/profile/<?= $objUnternehmensDaten->intUnternehmenID ?>.png"
											   alt="">
						<input type="file"
							   name="fileToUpload"
							   id="uploadbtn"
							   class="hidden">
					</div>
					<div class="row unternehmensname">
						<p id="uname"><?= $objUnternehmensDaten->strUnternehmenName ?></p>
					</div>
					<div class="row unternehmensort">
						Standort: <span id="uort"><?= $objUnternehmensDaten->strUnternehmenOrt ?></span><br><br>
					</div>
					<div class="row unternehmensbeschreibung">
						<p id="ubeschreibung"><?= $objUnternehmensDaten->strUnternehmenBeschreibung ?>
						</p>
					</div>
					<div class="changebtn">
						<input type="button"
							   id="changebtn"
							   value="Edit">
					</div>
				</form>
			</div>
		</div>
		<!-- End of Unternehmens Sidebar -->


		<!-- Popup Formular -->
		<div class="popupform">
			<div id="id01"
				 class="modal">
				<!-- Modal Content -->
				<form class="modal-content animate"
					  action="userinterface"
					  method="post">

					<div class="container">
						<label for="Jobtitel"><b>Jobtitel</b></label>
						<input type="text"
							   placeholder="Enter Username"
							   name="Jobtitel"
							   required>

						<label for="Standort"><b>Standort</b></label>
						<input type="text"
							   placeholder="Standort"
							   name="Standort"
							   required>

						<label for="jobbeschreibung"><b>Jobbeschreibung</b></label> <br>
						<textarea id="jobbeschreibung"
								  name="jobbeschreibung"></textarea>
					</div>
					<div class="container"
						 style="background-color:#f1f1f1">
						<button type="submit"
								class="createbtn">Create
						</button>
					</div>
					<div class="container"
						 style="background-color:#f1f1f1">
							<input type="file"
								   name="fileToUpload2"
								   id="uploadbtn"
								   class="hidden">
					</div>
				</form>
			</div>
		</div>
		<!-- End of Popup Formular -->


	</div>
</div>
<script src="js/ajax/UnternehmenInterface.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
