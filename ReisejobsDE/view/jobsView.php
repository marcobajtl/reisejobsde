<?php
/** @var Object $arrJobList
 * @var Array $arrFavJobs
 */

use model\enum\UserTypeEnum;

$_SESSION['csrf_token'] = hash("SHA256", uniqid('', true));

?>

<div>
    <?php include_once "quicksearch.php" ?>
</div>
<div class="container jobs">
    <?php if($arrJobList !== []): ?>
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
						<div class="col-12 col-lg-6 jobtextsection">
							<div class="textbox">
								<div class="row jobtitel"><?= $objJob->strTitel ?></div>
								<div class="row jobunternehmen"><?= $objJob->strName ?></div>
								<div class="row jobstandort">
									<span><i class="fa-light fa-map-location"></i> <?= $objJob->intPostleitzahl ?> <?= $objJob->strStandort ?></span>
								</div>
								<div class="row jobbeschreibung"><?= $objJob->strBeschreibung ?></div>
								<div class="row jobdatum"> Eingestellt am: <?= $objJob->strVeroeffentlicht ?></div>
							</div>
						</div>
						<div class="col-12 col-lg-3 ">
							<div class="jobctasection">
                                <?php if(isset($_SESSION['user_type'])): ?>
                                    <?php if($_SESSION['user_type'] === UserTypeEnum::BEWERBER): ?>
                                        <?php if(in_array(htmlentities($objJob->intID), array_column($arrFavJobs, 'FKJobID'), true)): ?>
											<button class="bewerbenbtn"><a href="benutzerbereich?bewerben=<?= $objJob->intFKUnternehmenID ?>">Jetzt Bewerben</a></button>
											<button class="favbtn redicon"
													id="<?= $objJob->intID ?>"><i class="fa-duotone fa-heart fa-xl"></i></button>
                                        <?php else: ?>
											<button class="bewerbenbtn"><a href="benutzerbereich?bewerben=<?= $objJob->intFKUnternehmenID ?>">Jetzt Bewerben</a></button>
											<button class="favbtn"
													id="<?= $objJob->intID ?>"><i class="fa-duotone fa-heart fa-xl"></i></button>
                                        <?php endif ?>
                                    <?php endif ?>

                                <?php else: ?>
									<button class="bewerbenbtn"><a href="login">Jetzt Bewerben</a></button>
									<button class="favbtn"
											id="<?= $objJob->intID ?>"><a href="login"><i class="fa-duotone fa-heart fa-xl"></i></a></button>
                                <?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
        <?php endforeach; ?>
    <?php else: ?>
		<div class="row justify-content-center">
			<div class="col-12 align-self-center">
				<h2 class="notfound">Dieser Arbeitgeber hat keine Verfügbaren Jobangebote</h2>
			</div>
		</div>
    <?php endif ?>
</div>
<script src="js/ajax/favorizejobs.js"></script>
<script src="js/ajax/QuickSearch.js"></script>