<?php
$_SESSION['csrf_token'] = hash("SHA256" ,uniqid('', true));
?>
<div class="container loginsite">
	<div class="row">
		<div class="col col-12 col-md-6 login">
            <?php if(isset($loginerror)): ?>
				<div class="loginerror">
					<p class="errortext">
                        <?= $loginerror ?>
					</p>
				</div>
            <?php endif ?>
			<div class="ta-ctr loginheader">
				<p>Login</p>
			</div>
			<!--suppress HtmlUnknownTarget -->
			<form class="needs-validation"
				  action="login"
				  method="post"
				  novalidate>
				<div class="form-group row justify-content-end">
					<div class="col-sm-8">
						<label for="inputEmail5"
							   class="col-sm-4 col-form-label">Email</label>
						<input type="email"
							   name="email"
							   class="form-control"
							   id="inputEmail5"
							   placeholder="Email"
							   required>
					</div>
				</div>
				<div class="form-group row justify-content-end">
					<div class="col-sm-8">
						<label for="inputPassword4"
							   class="col-sm-4 col-form-label">Password</label>
						<input type="password"
							   name="password"
							   class="form-control"
							   id="inputPassword4"
							   placeholder="Password"
							   autocomplete="on"
							   required>
					</div>
				</div>
				<div class="form-group row justify-content-end">
					<div class="col-sm-8">
						<button type="submit"
								class="btn btn-primary">Sign in
						</button>
					</div>
				</div>
				<div class="form-group row justify-content-end">

					<div class="col-sm-8">
						<a href="">Passwort vergessen?</a>
					</div>
				</div>
				<div class="form-group row justify-content-end">
					<div class="col-sm-8">
						<div class="form-check">
							<input class="form-check-input"
								   type="checkbox"
								   id="gridCheck2">
							<label class="form-check-label"
								   for="gridCheck2">
								Angemeldet bleiben?
							</label>
						</div>
					</div>
				</div>
				<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
			</form>
		</div>
		<div class="col col-12 col-md-6 register">
            <?php if(isset($registererror)): ?>
				<div class="loginerror">
					<p class="errortext">
                        <?= $registererror ?>
					</p>
				</div>
            <?php endif ?>
            <?php if(isset($registersuccess)): ?>
				<div class="loginerror">
					<p class="successtext">
                        <?= $registersuccess ?>
					</p>
				</div>
            <?php endif ?>
			<div class="ta-ctr">Account Anlegen</div>
			<!--suppress HtmlUnknownTarget -->
			<form action="login"
				  class="needs-validation"
				  id="registerform"
				  method="post"

				  novalidate>
				<fieldset class="form-group">
					<div class="row">
						<span class="col-form-label col-sm-4 pt-0"></span>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<input class="form-check-input"
									   type="radio"
									   name="usertype"
									   id="gridRadios1"
									   value="bewerber"
									   checked>
								<label class="form-check-label"
									   for="gridRadios1">
									Bewerber
								</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input "
									   type="radio"
									   name="usertype"
									   id="gridRadios2"
									   value="unternehmen">
								<label class="form-check-label"
									   for="gridRadios2">
									Unternehmen
								</label>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="form-group row">
					<label for="inputEmail3"
						   class="col-sm-4 col-form-label">Email</label>
					<div class="col-sm-8">
						<input type="email"
							   name="email"
							   class="form-control"
							   id="inputEmail3"
							   placeholder="Email"
							   required>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3"
						   class="col-sm-4 col-form-label">Password</label>
					<div class="col-sm-8">
						<input type="password"
							   name="password"
							   class="form-control"
							   id="inputPassword3"
							   placeholder="Password"
							   autocomplete="on"
							   required>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword6"
						   class="col-sm-4 col-form-label">Password Wiederholen</label>
					<div class="col-sm-8">
						<input type="password"
							   name="passwordwdh"
							   class="form-control"
							   id="inputPassword6"
							   placeholder="Password Wiederholen"
							   autocomplete="on"
							   required>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-10">
						<div class="form-check">
							<input class="form-check-input"
								   type="checkbox"
								   id="gridCheck1"
								   required>
							<label class="form-check-label"
								   for="gridCheck1">
								<small>Ich bestätige, dass ich die <!--suppress HtmlUnknownTarget -->
									<a href="/agb">AGB's</a> gelesen habe, und diese akzeptiere.</small>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit"
								class="btn btn-primary">Sign in
						</button>
					</div>
				</div>
				<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
			</form>
		</div>
	</div>
	<script src="js/validate.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
			crossorigin="anonymous"></script>