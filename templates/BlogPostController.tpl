<section>
	<header>
		<h1>{NAME}</h1>
		<div class="more">
			${LangLoader::get_message('by', 'common')} 
			<a href="{LINK_USER_PROFILE}" class="{USER_LEVEL_CLASS}" # IF C_USER_GROUP_COLOR # style="color:{USER_GROUP_COLOR}" # ENDIF #>{USER}
			</a>
			${LangLoader::get_message('the', 'common')}
			{CREATED}
		</div>
	</header>
	<article>
		<p>{CONTENT}</p>
	</article>
	<footer></footer>
</section>
<section>
	<header>
		<h1>Commentaires</h1>
		<div class="more"></div>
		# INCLUDE  COMMENTS #
	</header>
</section>