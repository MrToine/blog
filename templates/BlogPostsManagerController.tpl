# IF IS_AUTHOR_BLOG #
	<h1>Gestion des Billets</h1>
	<a href="{CREATE_POST_LINK}" class="basic-button">{@manager.create_post}</a>
	<table>
		<tr>
			<th>{@manager.posts.title}</th>
			<th>{@manager.posts.created}</th>
			<th>{@manager.posts.state}</th>
			<th>{@manager.posts.actions}</th>
		</tr>
		# START post #
		<tr>
			<td><a href="{@link_blog_post}/{post.SLUG}">{post.NAME}</a></td>
			<td>{post.CREATED}</td>
			<td>{post.STATE} <i class="fa {post.ICON}"></i></td>
			<td><a href="{post.EDIT_POST_LINK}" title="éditer"><i class="fa fa-edit"></i></a> | <a href="{post.DELETE_POST_LINK}"><i class="fa fa-delete"></i></a></td>
		</tr>
		# END post #
	</table>
# ELSE #
	<div class="error">Ce n'est pas ton blog.</div>
# ENDIF #