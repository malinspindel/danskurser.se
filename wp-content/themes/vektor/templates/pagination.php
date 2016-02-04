<?php if(function_exists('vektor_page_navi')): ?>

	<nav class="pagination">
	
		<?php vektor_page_navi(); ?>
		
	</nav>
	
<?php else: ?>

	<nav class="wp-prev-next">
	
		<ul class="clearfix">
		
			<li class="prev-link"><?php next_posts_link( __( '&larr; Older posts', 'vektor' )) ?></li>
			
			<li class="next-link"><?php previous_posts_link( __( 'Newer posts &rarr;', 'vektor' )) ?></li>
			
		</ul>
		
	</nav>
	
<?php endif; ?>