<?php require_once 'include/inc.php'; ?>
<?php if (checkLogin()) : ?>
<?php get('header'); ?>
<?php get('nav'); ?>
<div class="mt-5 pt-5">
	<div class="container px-0 rounded-lg mt-3 bg-light shadow" id="main">

		<!-- Profile Pic & Cover Pic -->
		<div id="k<?php //profile?>">
			<div class="media rounded-lg mx-0 bg-cover" style="background:linear-gradient( var(--softDark),  var(--softDark)), url('<?php url(); ?>assets/img/bg.jpg')">
				<img class="align-self-start rounded-circle w-25 m-5 mb-n5" src="<?php url(); ?>assets/img/user.png" alt="">
				<div class="media-body align-self-end pb-3">
					<h1 class="text-light">Krishna Gujjjar</h1>
					<h4 class="text-white-50">Student</h4>
				</div>
			</div>
		</div>

		<!-- Profile Data -->
		<div class="row rounded-lg mt-5">
			<div class="col-sm-12 px-3">

				<!-- About User Short text -->
				<div class="row pb-5 text-center">
					<div class="col-sm-2"></div>
					<div class="col-sm-8 px-5">
						<h5>Lorem, ipsum dolor.</h5>
						<p class="text-muted">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam praesentium illum voluptatem repudiandae,
							quod est quasi in id adipisci!
						</p>
					</div>
				</div>

				<!-- Tabs Link -->
				<ul class="nav nav-tabs nav-fill mt-1" role="tablist">
					<li class="nav-item">
						<a class="nav-link border-bottom-0 mb-0 lead font-weight-normal <?php 'active' ?>" href="#aboutMeTab" id="about-tab" data-toggle="tab" role="tab" aria-controls="aboutMeTab" aria-selected="false">
							About Me
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link border-bottom-0 mb-0 lead font-weight-normal active" href="#myPostTab" id="post-tab" data-toggle="tab" role="tab" aria-controls="myPostTab" aria-selected="true">
							My Posts
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link border-bottom-0 mb-0 lead font-weight-normal" href="#myFriendsTab" id="friend-tab" data-toggle="tab" role="tab" aria-controls="myFriendsTab" aria-selected="false">My Friends &nbsp;
							<span class="text-white badge badge-pill badge-muted">
								213
							</span>
						</a>
					</li>
				</ul>

				<!-- Tabs Panels -->
				<div class="tab-content bg-white border border-top-0 rounded-lg border-light" id="profileTabContainer">

					<!-- About User's Profile -->
					<div class="tab-pane fade p-5 show active" id="aboutMeTab" aria-labelledby="about-tab" role="tabpanel">
						<div class="row py-3">

							<?php if (1 == 2) : ?>
							<!-- No Post Found in Database -->
							<div class="col-sm-12 text-center mt-5">
								<img src="<?php url(); ?>assets/img/bg/profile.svg" alt="" class="w-50">
								<h1 class="py-5">
									Oops,
									<?php echo strtok($_SESSION['userName'], ' '); ?> Have Not Updated Profile Yet..!!!
								</h1>
								<a href="<?php url(); ?>">
									<button class="btn btn-primary btn-lg rounded-pill py-3 px-5" type="button">Update Profile !</button>
								</a>
							</div>
							<?php endif; ?>


							<div class="col-sm-12 px-md-5">
								<!-- Address -->
								<div class="card card-deck shadow-b border-light">
									<div class="card-body border-1 rounded border-left border-primary">
										<h3 class="text-primary card-title">
											about me...
										</h3>
										<hr class="w-50">

										<div class="container d-flex flex-column card-text">
											<div class="d-flex flex-column flex-md-row flex-fill">
												<div class="mb-5 flex-fill">
													<h5>
														<i class="text-info fas fa-user-astronaut mr-2"></i>
														user name
													</h5>
													<span class="text-muted pl-md-4">
														user_example
													</span>
												</div>
												<div class="flex-fill mb-5">
													<h5>
														<i class="text-info mr-2 fas fa-user-ninja"></i>
														gender
													</h5>
													<span class="text-muted pl-md-4">
														Male
													</span>
												</div>
												
											</div>
											<div class="flex-fill">
													<h5>
														<i class="text-info fas fa-map-marker-alt mr-2"></i>
														City
													</h5>
													<span class="text-muted pl-md-4">
														Kota, IN
													</span>
											</div>
										</div>
									</div>
								</div>

								<!-- Contact Info -->
								<div class="card card-deck shadow-b border-light mt-5">
									<div class="card-body border-1 rounded border-left border-primary">
										<h3 class="text-primary">
											Contact Info...
										</h3>
										<hr class="w-75">

										<div class="container d-flex flex-column flex-md-row py-3">
											<div class="flex-fill mb-5">
												<h5>
													<i class="text-info fas fa-envelope-open-text mr-2"></i>
													Email Address
												</h5>
												<span class="text-muted pl-md-4">
													user@example.com
												</span>
											</div>
											<div class="flex-fill">
												<h5>
													<i class="text-info fas fa-mobile-alt mr-2"></i>
													Mobile number
												</h5>
												<span class="text-muted pl-md-4">
													+91 987 654 3210
												</span>
											</div>
										</div>
									</div>
								</div>

								<!-- Skills -->
								<div class="card card-deck shadow-b border-light mt-5">
									<div class="card-body border-1 rounded border-left border-primary">
										<h3 class="text-primary">
											I'm <?php //echo ucwords($data['type']);?> at...
										</h3>
										<hr class="w-50">

										<div class="container">
											<div class="mb-4">
												<h5>
													<i class="text-info fas fa-file-signature mr-2"></i>
													Course<?php //($data['type'] == 'study') ? ucwords(print('course')) : ucwords(print('work')); ?>
												</h5>
												<span class="text-muted pl-md-4">
													Bechlor of Arts<?php //echo $data['kind'];?>
												</span>
											</div>
											<div class="mt-4">
												<h5>
													<i class="text-info fas fa-university mr-2"></i>
													From
												</h5>
												<span class="text-muted pl-md-4">
													Coder's University, Kota<?php //echo $data['location'];?>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<!-- User's Post -->
					<div class="tab-pane fade p-5 <?php 'show active' ?>" id="myPostTab" aria-labelledby="post-tab" role="tabpanel">
						<div class="row pt-5">

							<?php if (1 == 2) : ?>

							<!-- No Post Found in Database -->
							<div class="col-sm-12 text-center">
								<img src="<?php url(); ?>assets/img/bg/missing.svg" alt="" class="w-50">
								<h1 class="py-5">
									Oops,
									<?php echo strtok($_SESSION['userName'], ' '); ?> Have Not Posted Yet..!!!
								</h1>
								<a href="<?php url(); ?>">
									<button class="btn btn-primary btn-lg rounded-pill py-3 px-5" type="button">Post Now !</button>
								</a>
							</div>
							<?php endif; ?>
							
							<div class="col-sm-4 p-0">
									<a href="">
									<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
									
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
									<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
									
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
										<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
									<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
									
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
									<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
									
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
										<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
									<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
									
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
									<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
									
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
										<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
									<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
									
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
									<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
									
								</div>
								<div class="col-sm-4 p-0">
									<a href="">
										<img class="border border-light rounded-lg" src="<?php url(); ?>assets/img/bg.jpg" alt="">
									</a>
							</div>
						</div>
					</div>

					<!-- User's Friends -->
					<div class="tab-pane fade p-5" id="myFriendsTab" aria-labelledby="friend-tab" role="tabpanel">
						<div class="row pt-5">

							<?php if (1 == 2) : ?>
							<!-- No Post Found in Database -->
							<div class="col-sm-12 text-center">
								<img src="<?php url(); ?>assets/img/bg/friend.svg" alt="" class="w-50">
								<h1 class="py-5">
								</h1>Oops,
								<?php echo strtok($_SESSION['userName'], ' '); ?> Have Not Any Friends Yet..!!!
								</h1>
								<a href="<?php url(); ?>">
									<button class="btn btn-primary btn-lg rounded-pill py-3 px-5" type="button">Add Friends !</button>
								</a>
							</div>
							<?php endif; ?>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<?php get('footer'); ?>
<?php else : ?>
<?php redirect(); ?>
<?php endif; ?>