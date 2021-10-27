<?php
/** @var string $strJobTitel
 * @var string $strJobLocation
 * @var string $strJobDescription
 */
?>

<div class="container">
	<div class="row">
		<form action="editpost?ID=<?= $_GET["ID"] ?>"
			  method="post"
			  enctype="multipart/form-data">
			<div class="row">
				<input type="text"
					   name="jobtitel"
					   value="<?= $strJobTitel ?>">
			</div>
			<div class="row">
				<input type="text"
					   name="joblocation"
					   value="<?= $strJobLocation ?>">
			</div>
			<div class="row">
				<textarea name="jobdescription"
						  id=""
						  cols="30"
						  rows="10"><?= $strJobDescription ?></textarea>
			</div>
			<div class="row">
					<input type="file"
						   name="fileToUpload"
						   id="uploadbtn">
			<div><input type="submit"></div>
		</form>
	</div>
</div>