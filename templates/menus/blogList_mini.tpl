<section>
	<div class="module-mini-container">
	<head>
		<div class="module-mini-top">
			<h5 class="sub-title">{BEST_BLOGS}</h5>
		</div>
	</head>
	<article>
		<div class="module-mini-contents">
			<p><strong>{TITLE_VIEWS}</strong></p>
			# START views_blogs #
				<p><a href="{views_blogs.LINK}">{views_blogs.NAME}</a> - ({views_blogs.VIEWS} {views_blogs.TXT_VIEWS})</p>
			# END views_blogs #
			<hr />
			<p><strong>{TITLE_LAST}</strong></p>
				# START lasts_blogs #
					<p><a href="{lasts_blogs.LINK}">{lasts_blogs.NAME}</a> <!--<em>par <a href="{lasts_blogs.LINK_USER_PROFILE">{lasts_blogs.USERNAME}</a></em>--></p>
				# END lasts_blogs #
			<em>Il y a {NB_BLOGS} Blogs sur le site !</em>
		</div>
	</article>
	<footer>
		<div class="module-mini-bottom">
		</div>
	</div>
	</footer>
</section>