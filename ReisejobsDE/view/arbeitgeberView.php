<?php
/**
 * @var array $arrUnternehmen
 */

$_SESSION['csrf_token'] = hash("SHA256", uniqid('', true));

?>
<div class="arbeitgeber">
	<div>
        <?php include_once "quicksearch.php"; ?>
	</div>
	<div class="container">
		<div class="row">
            <?php
            foreach($arrUnternehmen

            as $objUnternehmen): ?>
			<div class="col-12 col-lg-6 mrg-top-20">
				<div class="arbeitgebercontainer">
					<div class="row">

						<div class="col-12 col-lg-6 imgsection piccol">
							<div class="row headerparprt">
                                <?php if(file_exists("bilder/upload/profile/" . $objUnternehmen->intUnternehmenID . ".png")): ?>
									<img src="bilder/upload/profile/<?= $objUnternehmen->intUnternehmenID ?>.png"
										 alt="">
                                <?php else: ?>
									<img src="bilder/upload/profile/default.png"
										 alt="">
                                <?php endif ?>
							</div>
						</div>

						<div class="col-12 col-lg-6">
						<div class="">
							<div class="headname tg-center"><?= $objUnternehmen->strUnternehmenName ?></div>
							<div class="location tg-center">Standort: <?= $objUnternehmen->strUnternehmenOrt ?></div>
						</div>
						<span class="angebote"><?= $objUnternehmen->intJobCount ?> Jobs</span>
						<div class="c2abtn">
							<button class=""><a href="jobs?ArbeitgeberID=<?= $objUnternehmen->intUnternehmenID ?>">Jobs Anzeigen</a></button>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php endforeach ?>
	</div>
</div>


<script src="js/ajax/QuickSearch.js"></script>