<?php $atp_searchformtxt = get_option('atp_searchformtxt') ? get_option('atp_searchformtxt') : 'Search'; ?>
<div class="search-box">
	<form method="get" action="<?php echo home_url(); ?>/">
		<input type="text" size="15" class="search-field" name="s" id="s" value="<?php _e('Search', 'iva_theme_front')?>" onfocus="if(this.value == '<?php _e('Search', 'iva_theme_front') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search', 'iva_theme_front') ?>';}"/>
	</form>
</div>