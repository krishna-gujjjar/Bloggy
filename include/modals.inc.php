<!-- SignUp Modals -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content bg-light pb-3">
			<!-- <div class="modal-header px-5 bg-primary text-white rounded"> -->
			<div class="modal-header px-5 bg-white text-dark rounded">
				<h3 class="modal-title">Sign Up</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body bg-light">
				<form action="" method="get" class="container px-5">
					<div class="form-group">
						<label for="ufname">Full Name :</label>
						<div class="form-inline">
							<div class="form-group">
								<input type="text" name="ufname" id="ufname" autocomplete="off" class="form-control" placeholder="eg. Krishna">
							</div>

							<div class="form-group ml-auto">
								<input type="text" name="ulname" id="ulname" autocomplete="off" class="form-control" placeholder="eg. Gujjjar">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="uemail">Email Address :</label>
						<input type="email" class="form-control" name="uemail" autocomplete="off" id="uemail" placeholder="eg. example123@gmail.com">
					</div>

					<div class="form-group">
						<label for="suPass">Password :</label>
						<input type="password" class="form-control" name="upass" autocomplete="off" id="suPass" placeholder="Password">
					</div>

					<button type="submit" class="btn btn-lg btn-success" name="signup" value="signup">Sign Up</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- SignIn Modal -->
<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-light pb-3">
			<!-- <div class="modal-header bg-primary rounded text-white"> -->
			<div class="modal-header bg-white rounded text-dark">
				<h3 class="modal-title">Sign In</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body bg-light">
				<form action="" method="post" id="signInForm">
					<div class="form-group">
						<label for="uname">Username :</label>
						<input type="text" class="form-control" name="uname" id="uname" placeholder="eg. example123@gmail.com">
					</div>
					<div class="form-group">
						<label for="upass">Password :</label>
						<input type="password" class="form-control" name="upass" autocomplete="off" id="upass" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-lg mt-1 btn-success" name="signin" value="signin" id="signin">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="cate" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-light pb-3">
			<div class="modal-header bg-primary rounded text-white">
				<h3 class="modal-title">Add Category</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<label for="cname">Category Name :</label>
						<input type="text" class="form-control" name="cname" id="cname" placeholder="eg. Category" autocomplete="off">
					</div>
					<button type="submit" class="btn btn-lg mt-1 btn-success" name="cate" value="create">Create</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- About Modal -->
<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content bg-light pb-3 border-0">
			<div class="modal-header border-0 bg-primary rounded-lg">
				<h3 class="modal-title ml-3 text-white">Features of Bloggy</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body bg-light">
				<ul class="px-5 blockquote">
					<li class="pl-3 text-muted">Dynamic Page Title & Head Title Using PHP.</li>
					<li class="pl-3 text-muted">Show Navigation Link According User's Location.</li>
					<li class="pl-3 text-muted">Dynamic Activating Class Using PHP .</li>
					<li class="pl-3 text-muted">Dynamic Post, Auto Add &lt;Pre&gt; & &lt;code&gt; According Post.</li>
					<li class="pl-3 text-muted">Highlight Code Using PHP Function.</li>
					<li class="pl-3 text-muted">Welcome Message After 24hr Later from Last Loged In Time.</li>
					<li class="pl-3 text-muted">User can Mantain own profile.</li>
					<li class="pl-3 text-muted">Active user can send Friend Request to other active user, When they Accept, Both can able to send Message to each other.</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div id="myPopup"></div>