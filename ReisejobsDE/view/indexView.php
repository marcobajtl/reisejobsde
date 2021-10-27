<?php
/** @var array $arrJobList */
?>
<div class="container index">

	<?php include_once "quicksearch.php"?>

	<div class="row topjobs">
		<div class="jobheader">
			<h1>Die aktellen Top-Jobs</h1>
		</div>
        <?php foreach ($arrJobList as $arrJob): ?>
		<div class="piccol">
            <?php if(file_exists("bilder/upload/job/$arrJob->intJobID.png")):?>
			<img src="bilder/upload/job/<?=$arrJob->intJobID ?>.png"
				 alt="">
			<?php endif?>
			<?php if(!file_exists("bilder/upload/job/$arrJob->intJobID.png")):?>
			<img src="bilder/upload/job/default.png"
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