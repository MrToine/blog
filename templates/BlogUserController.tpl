<section>
	<content>
		<div class="content">
			<div class="options info" style="width:200px;">
				# IF IS_AUTHOR_BLOG #
						<h3>Gestion du blog</h3>
						<p><a href="{CREATE_POST_LINK}">{@manager.create_post}</a></p>
						<p><a href="{MANAGE_POSTS_LINK}">{@manager.manage_posts}</a></p>
						<p><a href="{MANAGE_BLOG_LINK}">{@manager.admin_blog}</a></p>
				# ENDIF #
				# IF MENU_FOR_BLOG #
					<div class="module-mini-container">
						<div class="module-top">
							<h5>{@mini.module.aboutme}</h5>
						</div>
						<div classe="module-contents">	
							<p>{ABOUT_ME}</p>
						</div>
					</div>						
				# ENDIF #
			</div>
		</div>	
		<header>
			<div class="blog_name">{BLOG_NAME}</div>
		</header>
		<div itempro="text">
		# START blogUserPost #
			# IF blogUserPost.APPROVED #
					<header>
						<h1>{blogUserPost.NAME}</h1>
						<div class="more">
							${LangLoader::get_message('by', 'common')}
							<a href="{LINK_USER_PROFILE}" class="{USER_LEVEL_CLASS}" # IF C_USER_GROUP_COLOR # style="color:{USER_GROUP_COLOR}" # ENDIF #>{USER}
							</a>
							${LangLoader::get_message('the', 'common')}
							{blogUserPost.CREATED}
							- {NB_COMMENTS} {@module.comments}
						</div>
					</header>
					<div class="content">
						<p>{blogUserPost.SHORT_CONTENT}...
							<br />
							<a href="{@link_blog_post}/{blogUserPost.SLUG}">{@read_more}</a>
						</p>
					</div>
				# ENDIF #
			# END blogUserPost #
			</div>
			<center><em>Ce blog à était vue {VIEWS} fois.</em></center>
	</content>
</section>
