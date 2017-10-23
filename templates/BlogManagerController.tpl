# IF IS_AUTHOR_BLOG #
<section>
	<header>
		<p>{@manager.manager_head_message}</p>
		# IF IS_NOT_APPROVED #
			<div class="warning">{@manager.blog.not.approved}</div>
		# END IF #
		<span style="font-size:22pt;text-align:center"><a href="{LINK_BLOG}">Voir mon blog</a></span>
	</header>
	<article>
		<ul class="blog_user_menu">
			<!--<li><a href=""><i class="fa fa-wrench fa-2x"></i><br /><br />{@manager.admin_blog}</a></li>-->
			<li><a href="{CREATE_POST_LINK}"><i class="fa fa-file fa-2x"></i><br /><br />{@manager.create_post}</a></li>
			<li><a href="{MANAGER_POSTS_LINK}"><i class="fa fa-file-text-o fa-2x"></i><br /><br />{@manager.manage_posts}</a></li>
			<!--<li><a href="delete/{ID_CREATOR}"><i class="fa fa-delete fa-2x"></i><br /><br />{@manager.delete_blog}</a></li>-->
		</ul>
	</article>
	<footer>
		
	</footer>
</section>
# ENDIF #