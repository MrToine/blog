# IF IS_AUTHOR_BLOG #
	# IF FORM_OK #
		<div class="success">{@manager.success.posted}</div>
	# ELSE #
		# INCLUDE form #
	# ENDIF #
# ELSE #
	<div class="error">{@manager.is.no.your.blog}</div>
# ENDIF #

