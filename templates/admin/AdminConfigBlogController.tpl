# IF FORM_OK #
	<div class="success">{@config.form.success}</div>
# ENDIF #
<h1>{@config.module.configuration}</h1>
<p>{@config.form.intro}</p>

# INCLUDE form_config #

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