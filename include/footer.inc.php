		<footer class="bg-white text-dark mt-5 p-3">
		<!-- <footer class="bg-primary text-light mt-5 p-3"> -->
			<div class="container text-center">
				<a href="<?php url(); ?>" class="text-dark">
					<h3>Bloggy</h3>
				</a>
				<p class="mb-0">All Right Reserved &copy; <a href="<?php url(); ?>" class="text-muted">Bloggy</a>
					<?php echo date('Y ', time()) ?>
				</p>
			</div>
		</footer>

		<?php get('modals'); ?>
		<?php logout(); ?>
		<?php signUp(); ?>
		<?php signIn(); ?>
		<?php get_script(); ?>
	</div>
</body>

</html>