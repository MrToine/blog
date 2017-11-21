<section>
	# IF IS_AUTHOR_BLOG #
		<div class="content">
			<div class="options info">
				<h3>Gestion du blog</h3>
				<p><a href="{CREATE_POST_LINK}">{@manager.create_post}</a></p>
				<p><a href="{MANAGE_NEWS_LINK}">{@manager.manage_posts}</a></p>
				<p><a href="{MANAGE_BLOG_LINK}">{@manager.admin_blog}</a></p>
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
		<h1>Commentaires ({NB_COMMENTS})</h1>
		<div class="more"></div>
		# INCLUDE  COMMENTS #
	</header>
</section>