<?php
/**
 * WordPress Footer file - contains mark-up
 * for the footer of the website
 */
?>

		<footer id="main-footer">
			<!-- Info -->
			<div class="site-info wrapper clearfix">
				<div class="col-md-6 social-icons">
					<a href="#" class="icons" target="_blank"><i class="fa fa-github"></i></a>
					<a href="#" class="icons" target="_blank"><i class="fa fa-stack-exchange"></i></a>
				</div>
				<div class="col-md-6 copyright">
					<p>Copyright &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.</p>
				</div>
			</div>
		</footer>

	</div>
	<!-- ./Site Container -->

<!-- WordPress Footer -->
<?php wp_footer(); ?>
</body>
</html>