<table>
	<thead>
		<th></th>
		<th width="20%">{HEAD_USER}</th>
		<th width="50%">{HEAD_NAME}</th>
		<th width="10%">{HEAD_CREATED}</th>
		<th width="10%">{@admin.manager.approved}</th>
	</thead>
	<tbody>
		# START blog #
			<tr>
				<td # IF NOT blog.APPROVED # style="background:#FFCACA;" # ENDIF #># IF NOT blog.APPROVED # <a href="{blog.APPROVE_LINK}">Approuver ce blog</a> # ELSE # <a href="{blog.DESAPPROVE_LINK}">Désapprouver ce blog</a> # ENDIF #<!--{@admin.manager.delete.blog}--></td>
				<td # IF NOT blog.APPROVED # style="background:#FFCACA;" # ENDIF #>
					<a href="{blog.LINK_USER_PROFILE}" class="{blog.USER_LEVEL_CLASS}">{blog.USERNAME}</a>
				</td>
				<td  # IF NOT blog.APPROVED # style="background:#FFCACA;" # ENDIF #><a href="{blog.LINK_BLOG_USER}">{blog.NAME}</a><br /><small><em>{blog.DESCRIPTION}</em></small></td>
				<td # IF NOT blog.APPROVED # style="background:#FFCACA;" # ENDIF #>{CREATED}</td>
				<td # IF NOT blog.APPROVED # style="background:#FFCACA;" # ENDIF #># IF NOT blog.APPROVED # <span style="color:red">{@admin.manager.blog.not.approved}</span> # ELSE # <span style="color:green">{@admin.manager.blog.approved}</span> # ENDIF # </td>
			</tr>
		# END blog #			
	</tbody>
</table>

<h2>Informations</h2>
<div class="success">
	{@donation}<br />
	<a href="mailto:{@mail.creator.module}">{@mail.creator.module}</a><br />
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="YDTURCBBF53M4">
		<input type="image" src="https://www.paypalobjects.com/fr_FR/BE/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne" target="_bank">
		<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>