<section>
	# IF IS_AUTHOR_BLOG #
		<div class="content">
			<div class="options info">
				<h3>Gestion du blog</h3>
				<p><a href="{@manager.create_post_link}">{@manager.create_post}</a></p>
				<p><a href="{@manager.manage_posts_link}">{@manager.manage_posts}</a></p>
				<p><a href="{@manager.admin_blog_link}">{@manager.admin_blog}</a></p>
			</div>
		</div>			
	# ENDIF #
	<header>
		<h1>{NAME}</h1>
		<div class="more">
			${LangLoader::get_message('by', 'common')} 
			<a href="{LINK_USER_PROFILE}" class="{USER_LEVEL_CLASS}" # IF C_USER_GROUP_COLOR # style="color:{USER_GROUP_COLOR}" # ENDIF #>{USER}
			</a>
			${LangLoader::get_message('the', 'common')}
			{CREATED}
		</div>
	</header>
	<p>{CONTENT}</p>
	<footer></footer>
</section>
<section>
	<header>
		<h1>Commentaires</h1>
		<div class="more"></div>
		# INCLUDE  COMMENTS #
	</header>
</section>