# IF IS_AUTHOR_BLOG #
	# IF FORM_OK #
		<div class="success">Billet edité</div>
	# ELSE #
		# INCLUDE form #
	# ENDIF #
# ELSE #
	<div class="error">Ce n'est pas ton blog</div>
# ENDIF #