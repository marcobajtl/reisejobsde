<?php
/** @var array $arrJobList */

$_SESSION['csrf_token'] = hash("SHA256", uniqid('', true));

?>
<?php include_once "quicksearch.php"?>
<div class="container index">
	<div class="row topjobs">
		<div class="jobheader">
			<h1>Die aktellen Top-Jobs</h1>
		</div>
        <?php foreach ($arrJobList as $arrJob): ?>
		<div class="piccol">
            <?php if(file_exists("bilder/upload/profile/$arrJob->intUnternehmenID.png")):?>
			<img src="bilder/upload/profile/<?=$arrJob->intUnternehmenID ?>.png"
				 alt="">
			<?php else:?>
			<img src="bilder/upload/profile/default.png"
				 alt="">
			<?php endif?>
			<div class="floatingtext toppos ta-ctr va-ctr">
				<p><?=$arrJob->strUnternehmenName ?></p>
			</div>
			<div class="floatingtext bottompos ta-ctr va-ctr">
				<p><?=$arrJob->strJobName ?></p>
			</div>
		</div>
		<?php endforeach; ?>


		<script src="js/ajax/QuickSearch.js"></script>
	</div>
</div>