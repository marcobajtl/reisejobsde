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
			<input type="hidden"
				   name="csrf_token"
				   value="<?= $_SESSION['csrf_token'] ?>" />
			<div class="row">
				<label for="jobtitel">
					<input type="text"
						   id="jobtitel"
						   name="jobtitel"
						   value="<?= $strJobTitel ?>">
				</label>
			</div>
			<div class="row">
				<label for="joblocation">
					<input type="text"
						   id="joblocation"
						   name="joblocation"
						   value="<?= $strJobLocation ?>">
				</label>
			</div>
			<div class="row">
				<label for="jobdescription"></label>
				<textarea name="jobdescription"
						  id="jobdescription"
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