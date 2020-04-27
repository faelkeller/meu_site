<div class="section-item clearfix">
	<i class="icon-item dashicons dashicons-megaphone"></i>
	<div class="content-item">
		<h2><?php esc_html_e('Recommended Actions', 'clean-retina'); ?></h2>
		<p><?php esc_html_e('Complete the list of steps so that you can set up your site same like our demo which is very easy to follow.', 'clean-retina'); ?></p>
		<a class="th-btn" href="<?php echo esc_url( admin_url('themes.php?page=clean-retina-details&section=recommended_actions') ); ?>"><?php esc_html_e('Recommended Actions', 'clean-retina'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<i class="icon-item dashicons dashicons-book-alt"></i>
	<div class="content-item">
		<h2><?php esc_html_e('Read Full Documentation', 'clean-retina'); ?></h2>
		<p><?php printf(
			/* translators: Theme Name */
			esc_html__('Read our full documentation for all the detailed information on how to setup and use %s theme.', 'clean-retina'), esc_html($this->theme_name) ); ?></p>
		<a class="th-btn" target="_blank" href="<?php echo esc_url( 'http://themehorse.com/theme-instruction/clean-retina/' ); ?>"><?php esc_html_e('Read Full Documentation', 'clean-retina'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<i class="icon-item dashicons dashicons-admin-customizer"></i>
	<div class="content-item">
		<h2><?php esc_html_e('Theme Options', 'clean-retina'); ?></h2>
		<p><?php esc_html_e('All settings and theme options are available via "Customizer" where you can easily customize different aspects of the theme.', 'clean-retina'); ?></p>
		<a class="th-btn" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Go to Theme Options', 'clean-retina'); ?></a>
	</div>
</div>
