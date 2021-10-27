<?php
/**
 * @var array $arrUnternehmen
 */
?>
<div class="arbeitgeber">
	<div class="container">
		<div class="row">


            <?php include_once "quicksearch.php";
            foreach($arrUnternehmen

            as $strPosition): ?>
			<div class="col-12 col-lg-6 mrg-top-20">
				<div class="arbeitgebercontainer">
					<div class="row">

						<div class="col-12 col-lg-6 imgsection piccol">
							<div class="row headerparprt">
                                <?php if(file_exists("bilder/upload/profile/" . $strPosition->intUnternehmenID . ".png")): ?>
									<img src="bilder/upload/profile/<?= $strPosition->intUnternehmenID ?>.png"
										 alt="">
                                <?php endif ?>
                                <?php if(!file_exists("bilder/upload/profile/" . $strPosition->intUnternehmenID . ".png")): ?>
									<img src="bilder/upload/profile/default.png"
										 alt="">
                                <?php endif ?>
							</div>
						</div>

						<div class="col-12 col-lg-6">
						<div class="">
							<div class="headname tg-center"><?= $strPosition->strUnternehmenName ?></div>
							<div class="tg-center">Standort: <?= $strPosition->strUnternehmenOrt ?></div>
						</div>
						<span class="angebote"><?= $strPosition->intJobCount[0] ?></span>
						<div class="c2abtn">
							<button class="">Jobs Anzeigen</button>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php endforeach ?>
	</div>
</div>


<script src="js/ajax/QuickSearch.js"></script>