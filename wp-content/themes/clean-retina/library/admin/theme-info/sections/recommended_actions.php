<div class="section-item clearfix">
	<div class="icon-item"><?php esc_html_e('Step 1:', 'clean-retina'); ?></div>
	<div class="content-item">
		<h3><?php esc_html_e('Create a new page with "Front Page Template"', 'clean-retina'); ?></h3>
		<ol>
			<li><?php esc_html_e('Create a new page with any title.', 'clean-retina'); ?></li>
			<li><?php echo sprintf( esc_html__('Select %1$s"Corporate Template"%2$s for the option %1$sPage Attributes > Template%2$s which you can find it from the right section of the page editor.', 'clean-retina'), '<strong>', '</strong>'  ); ?></li>
			<li><?php esc_html_e('Click on Publish', 'clean-retina'); ?></li>
		</ol>
		<a class="th-btn" target="_blank" href="<?php echo esc_url(admin_url('post-new.php?post_type=page')); ?>"><?php esc_html_e('Create New Page', 'clean-retina'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<div class="icon-item"><?php esc_html_e('Step 2:', 'clean-retina'); ?></div>
	<div class="content-item">
		<h3><?php esc_html_e('Set "Your homepage displays" to "A Static Page"', 'clean-retina'); ?></h3>
		<ol>
			<li><?php echo sprintf( esc_html__('Go to %1$s"Appearance > Customize > Homepage Settings"%2$s.', 'clean-retina'), '<strong>', '</strong>'  ); ?></li>
			<li><?php echo sprintf( esc_html__('Set %1$s"Your homepage displays"%2$s to %1$s"A Static Page"%2$s.', 'clean-retina'), '<strong>', '</strong>'  ); ?></li>
			<li><?php echo sprintf( esc_html__('Select the page that you have created in the %1$s"Step 1"%2$s for %1$s"Homepage"%2$s.', 'clean-retina'), '<strong>', '</strong>'  ); ?></li>
			<li><?php esc_html_e('Click on Publish', 'clean-retina'); ?></li>
		</ol>
		<a class="th-btn" target="_blank" href="<?php echo esc_url(admin_url('options-reading.php')); ?>"><?php esc_html_e('Assign Static Page', 'clean-retina'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<div class="icon-item"><?php esc_html_e('Step 3:', 'clean-retina'); ?></div>
	<div class="content-item">
		<h3><?php esc_html_e('Now set "Pages" to "Corporate Page Template"', 'clean-retina'); ?></h3>
		<ol>
			<li><?php echo sprintf( esc_html__('Go to %1$s"Appearance > Customize > Advanced Options > Corporate Page Template Option"%2$s.', 'clean-retina'), '<strong>', '</strong>'  ); ?></li>
			<li><?php echo sprintf( esc_html__('Select the pages that you want to show in %1$sCorporate page template %2$s from the dropdown option.', 'clean-retina'), '<strong>', '</strong>'  ); ?></li>
			<li><?php esc_html_e('Click on Save', 'clean-retina'); ?></li>
		</ol>
		<a class="th-btn" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php esc_html_e('Go to Customize', 'clean-retina'); ?></a>
	</div>
</div>
<div class="section-item clearfix">
	<div class="icon-item"><?php esc_html_e('Step 4:', 'clean-retina'); ?></div>
	<div class="content-item">
		<h3><?php esc_html_e('Theme Options', 'clean-retina'); ?></h3>
		<p><?php echo sprintf( esc_html__('Theme uses customizer API for theme options. All settings and theme options are available via %1$s"Appearance > Customize"%2$s where you can easily customize different aspects of the theme.', 'clean-retina'), '<strong>', '</strong>'  ); ?></p>
		<a class="th-btn" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php esc_html_e('Go to Theme Options', 'clean-retina'); ?></a>
	</div>
</div>