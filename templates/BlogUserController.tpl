<section>
	<header>
		<div class="blog_name">{BLOG_NAME}</div>
	</header>
	# START blogUserPost #
		# IF blogUserPost.APPROVED #
			<article>
				<header>
					<h1>{blogUserPost.NAME}</h1>
					<div class="more">
						# IF C_EDIT #
							<a href="#">Editer</a>
						# ENDIF #
						${LangLoader::get_message('by', 'common')}
						<a href="{LINK_USER_PROFILE}" class="{USER_LEVEL_CLASS}" # IF C_USER_GROUP_COLOR # style="color:{USER_GROUP_COLOR}" # ENDIF #>{USER}
						</a>
						${LangLoader::get_message('the', 'common')}
						{blogUserPost.CREATED}
					</div>
				</header>
				<div class="content">
					<p>{blogUserPost.SHORT_CONTENT}...
						<br />
						<a href="{@link_blog_post}/{blogUserPost.SLUG}">{@read_more}</a>
					</p>
				</div>
			</article>
		# ENDIF #
	# END blogUserPost #
</section>
	