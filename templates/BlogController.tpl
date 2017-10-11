<div class="content">
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
						<td style="text-align:left;"><a href="{LINK_BLOG_USER}/{blog.ID}">{blog.NAME}</a><br /><small><em>{blog.DESCRIPTION}</em></small></td>
						<td>{CREATED}</td>
					</tr>
				# ENDIF #
			# END blog #			
		</tbody>
	</table>
</div>