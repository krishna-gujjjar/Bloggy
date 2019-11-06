<?php
//Add Post Function 
function createPost()
{

	echo $_REQUEST['postCnt'];

	?>


	<?php

}


//Show Input Box for Adding Post
function showAddPost()
{ ?>
	<form class="mb-5 px-5 pt-3 shadow-sm bg-white rounded" method="post" enctype="multipart/form-data" id="createPostForm">
		<input type="text" class="form-control border-0 py-5 bold validGroup" id="postCnt" name="postCnt" placeholder="What's on mind, <?php echo strtok($_SESSION['userName'], ' '); ?>">
		<!-- <input type="text" class="form-control validGroup" id="postCnt2" name="postCnt2" placeholder="<?php echo strtok($_SESSION['userName'], ' '); ?>"> -->
		<div class="py-3 pb-5 bg-white clearfix">
			<div class="float-right form-inline">
				<div class="form-group mr-3">
					<label for="postImg" data-toggle="tooltip" data-placement="top" title="Upload Pic!">
						<i class="fab fa-instagram fa-xl"></i>
					</label>
					<input type="file" class="d-none validGroup" name="postImg" id="postImg">
				</div>
				<div class="form-group mr-3 ml-3">
					<div class="dropdown">
						<label for="myCode" data-toggle="dropdown">
							<span class="h4" id="myCode" data-toggle="tooltip" title="Your Code Goes Here! &#128293;">
								{ }
							</span>
						</label>
						<div class="dropdown-menu p-3 shadow-lg">
							<div class="form-group">
								<label for="code">Your Code</label>
								<textarea id="postCode" class="form-control" name="postCode" rows="3" placeholder="<code>Your Code</code>"></textarea>
							</div>
							<div class="form-group pt-3">
								<?php category(); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group ml-3">
					<label for="createPost"><i class="fas fa-arrow-right fa-xl"></i></label>
					<button type="button" class="d-none" name="createPost" id="createPost"></button>
				</div>
			</div>
		</div>
	</form>
<?php 
}


//Show Post
function posts()
{
	$postQuery = run("SELECT post.*, user.uid, user.ufname, cate.cid, cate.cname FROM post INNER JOIN user ON post.uid = user.uid INNER JOIN cate ON post.cid = cate.cid WHERE post.pstatus=1 ORDER BY post.create_date DESC");
	if (countData($postQuery)) :
		foreach ($postQuery as $data) : ?>
	<div class="card mb-5 shadow-sm">
		<div class="card-header pb-0">
			<div class="row p-3">
				<div class="col-sm-1 p-1">
					<img src="upload/user.png" class="rounded-circle" alt="">
				</div>

				<div class="col-sm-10 py-1">
					<h3 class="card-title">
						<?php echo ucwords($data['ufname']); ?>
					</h3>
					<span class="text-muted ml-3">
						<i class="fa fa-arrow-alt-circle-right"></i>&nbsp;
						<?php //Change 'create_date' in All Table Because It's Interupt. ?>
						<?php echo showPostTime($data['create_date']); ?>
						
					</span>
				</div>
			</div>
		</div>
		<div class="card-body px-5">
			<h3 class="card-title">
				<?php echo ucwords($data['pname']); ?>
			</h3>
			<hr class="w-25 text-secondary">
			<p class="card-text text-justify text-muted py-3">
				<?php if (strlen($data['pcnt']) <= 200 || empty($data['pimg'])) : ?>
				<?php echo ucfirst($data['pcnt']); ?>
				<?php else : ?>
				<?php trimLongPost($data['pcnt']); ?>
				<a href="<?php url(); ?>post">View More</a>
				<?php endif; ?>
			</p>
			<?php if (!empty($data['pimg'])) ://Search in 'pcnt' php tag or html tag or create another container for code ?>
			<pre>
			<code>
	&lt;?php url(); ?&gt;updatePost?post=&lt;?php echo $data['pid']; ?&gt;
			</code>
			</pre>
			<?php endif; ?>

			<?php if (!empty($data['pimg'])) : ?>
			<div class="mb-3">
				<img src="<?php echo $data['pimg']; ?>" class="rounded w-50" alt="">
			</div>
			<?php endif; ?>
			<!-- <a href="#" class="card-link badge badge-primary p-2">Link 1</a> -->
			<a href="#" class="card-link badge badge-secondary p-2 px-3 mt-auto mb-1">
				<?php echo strtoupper($data['cname']); ?>
			</a><?php $like = json_decode($data['plike'], true); ?>
			
			<?php if (count($like) > 0) : ?>
			<span class="text-muted d-block mt-4 pb-0">
				<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
				<?php showLike($like); ?>
			</span>
			<?php endif; ?>
		</div>
		<?php if (checkLogin()) : ?>	
			<?php $uid = $_SESSION['userid']; ?>
		<div class="card-footer bg-white py-3">
			<div class="row text-muted text-center">
				<div class="col-sm-3 border-right border-secondary">
					<span id="<?php checkLike($uid, $like, 'unlike', 'like'); ?>_<?php echo $data['pid'] ?>" class="click cursor <?php checkLike($uid, $like, 'light', 'danger'); ?> font-reset">
						<i class="fas fa-heart fa-lg <?php checkLike($uid, $like, 'text-danger', 'text-mutedLight'); ?>"></i>
					</span>
				</div>
				<div class="col-sm-3 text-muted cursor" aria-hidden="true" data-target="#commentPost-<?php echo $data['pid'] ?>" data-toggle="collapse" aria-expanded="false" aria-controls="commentPost-<?php echo $data['pid'] ?>">
					<i class="fa fa-comment fa-lg text-muted"></i>&nbsp; 22 Comments
				</div>
				
			</div>
				<div id="commentPost-<?php echo $data['pid'] ?>" class="bg-light rounded-lg collapse mt-3 nm-fill mb-n3
				py-3">
					<form method="get" action="" class="my-3 px-5">
						<div class="input-group">
							<input type="text" class="form-control shadow-b rounded-pill px-4 pr-5 position-relative d-flex" placeholder="Hey <?php echo strtok($_SESSION['userName'], ' '); ?>, Your Comment..!!!">
							<i id="commented" class="fas fa-paper-plane mr-4 position-absolute align-self-center cursor inputSend"></i>
						</div>
						<div class="border-top border-light mt-3">
							<div class="media bg-white rounded-lg border border-light shadow-b p-3 mt-3 mx-3">
								<img class="align-self-start w-5 rounded-circle mr-3" src="<?php url(); ?>assets/img/user.png" alt="">
								<div class="media-body">
									<h5 class="mb-0">Krishna Gujjjar</h5>
									<span class="badge badge-muted text-light badge-pill my-2">15 min ago</span>
									<p class="text-muted mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores saepe quos ut praesentium reprehenderit dolorem aperiam quo laudantium voluptas esse!</p>
								</div>
							</div>

							<div class="media bg-white rounded-lg border border-light shadow-b p-3 mt-3 mx-3">
								<img class="align-self-start w-5 rounded-circle mr-3" src="<?php url(); ?>assets/img/user.png" alt="">
								<div class="media-body">
									<h5 class="mb-0">Krishna Gujjjar</h5>
									<span class="badge badge-muted text-light badge-pill my-2">15 min ago</span>
									<p class="text-muted mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. </p>
								</div>
							</div>
						</div>
					</form>

					
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
	<?php

}


//Post Actions Function
function postAction($action, $postID)
{
	$uid = $_SESSION['userid'];
	$pid = $postID;
	$showpost = run("SELECT plike FROM post WHERE pid = $pid"); //Get Post's Likes

	if (countData($showpost)) {
		$data = mysqli_fetch_assoc($showpost);
		$like = json_decode($data['plike'], true); //Convert To PHP Array

		if ($action == 'like') { //Like Post

			if (is_null($like)) { //When No one Like Post
				$like = array(); //Create Array
			}

			if (!in_array($uid, $like)) { //Check Liked Post
				$like[] = (int)$uid; //Liking Post
			} else {
				return false;
			}

		} elseif ($action == 'unlike') { //Unlike Post

			if (!is_null($like)) {
				unset($like[array_search($uid, $like)]); //Remove User
			} else {
				return false;
			}

		}

		$like = json_encode($like);//Convert To Object
		$likePost = run("UPDATE post SET plike = '$like' WHERE pid = '$pid'"); //Update Database

		if ($likePost) { //Check Database is Update
			return true;
		} else {
			return false;
		}

	} else {
		return false;
	}

}


//Check User Like Or Not
function checkLike($val, $array, $true, $false)
{
	if (is_array($array)) {
		if (in_array($val, $array)) {
			echo $true;

		} else {
			echo $false;
		}
	} else {
		echo $false;
	}
}

function showLike($array)
{
	if (is_array($array)) {
		$showUser = run("SELECT uid,ufname FROM user WHERE ustatus=1 AND ulevel=0 ORDER BY uid DESC");
		if (countData($showUser)) {
			$total = count($array);
			if (checkLogin()) {
				$i = $_SESSION['userid'];
			} else {
				$i = 0;
			}
			if ($total == 1) {
				foreach ($showUser as $data)
					if (in_array($data['uid'], $array)) {
					if (in_array($i, $array)) {
						echo 'You Like it.';
					} else {
						echo ucwords($data['ufname']) . ' Like it.';
					}
				}
			} else {
				$data = mysqli_fetch_array($showUser);
					//1, 2, 3
				foreach ($showUser as $data) {
					if (in_array($data['uid'], $array)) {
						$users = $data['ufname']; //1

						if (in_array($i, $array)) {
							$you = 'You';
						} else {
							$you = ucwords($data['ufname']); //1
						}
					}
				}
				echo $you . ' and ' . ($total - 1) . ' others';
			}
		}
	}
}