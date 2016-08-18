<form method="get" id="search_form" action="<?php bloginfo('home'); ?>/">
	<input type="text" class="search_input" value="SEARCH" name="s" placeholder="Search" id="s" onfocus="if (this.value == 'SEARCH') {this.value = '';}" onblur="if (this.value == '') {this.value = 'SEARCH';}" />
	<input type="hidden" id="searchsubmit" value="Search" />
</form>