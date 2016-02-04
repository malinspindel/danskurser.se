<aside class="social clearfix">

	<h6>Dela</h6>

		<ul class="social">

			<li><a target="facebook" class="social" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href, 'facebook', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');"><i class="fa fa-facebook-official"></i></a></li>

			<li><a target="twitter" class="social" href="http://twitter.com/home?status=<?php the_permalink(); ?>+<?php echo rawurlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href, 'twitter', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');"><i class="fa fa-twitter"></i></a></li>

			<li><a target="linkedin" class="social" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>&amp;summary=<?php echo rawurlencode(get_the_excerpt()); ?>" onclick="javascript:window.open(this.href, 'linkedin', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');"><i class="fa fa-linkedin"></i></a></li>

		</ul>

</aside>