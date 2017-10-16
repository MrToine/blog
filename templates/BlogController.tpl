# IF DISPLAY_BLOC #
	# START blog #
		<article class="block" style="height:150px;/*float:left,*/width:98%;margin-bottom:20px;">
			<header>
				<h2><a href="{blog.LINK_BLOG_USER}">{blog.NAME}</a></h2>
				<div class="more">
					<a href="{blog.LINK_USER_PROFILE}" class="{blog.USER_LEVEL_CLASS}" # IF C_USER_GROUP_COLOR # style="color:{USER_GROUP_COLOR}" # ENDIF #>{blog.USERNAME}</a>
				</div>
			</header>
			<div class="content">{blog.DESCRIPTION}</div>
			<footer>{CREATED}</footer>
		</article>
	# END blog #
# ELSE #
	<table>
		<thead>
			<th width="20%">{HEAD_USER}</th>
			<th width="50%">{HEAD_NAME}</th>
			<th width="10%">{HEAD_CREATED}</th>
		</thead>
		<tbody>
			# START blog #
				# IF blog.APPROVED #
					<tr>
						<td>
							<a href="{blog.LINK_USER_PROFILE}" class="{blog.USER_LEVEL_CLASS}" # IF C_USER_GROUP_COLOR # style="color:{USER_GROUP_COLOR}" # ENDIF #>{blog.USERNAME}</a>
						</td>
						<td style="text-align:left;"><a href="{blog.LINK_BLOG_USER}">{blog.NAME}</a><br /><small><em>{blog.DESCRIPTION}</em></small></td>
						<td>{CREATED}</td>
					</tr>
				# ENDIF #
			# END blog #			
		</tbody>
	</table>
# ENDIF #