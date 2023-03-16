<?php 

require get_template_directory() . '/library/admin/attached_posts/cmb2-attached-posts-field.php';

require get_template_directory() . '/library/admin/cpt/google_map_meta.php';
require get_template_directory() . '/library/admin/cpt/cpt.php';
require get_template_directory() . '/library/admin/cpt/cpt_tax.php';
require get_template_directory() . '/library/admin/cpt/cpt_meta.php';
require get_template_directory() . '/library/admin/cpt/manage_column.php';
require get_template_directory() . '/library/admin/user_roles/add_user_roles.php';

/* Widgets */
require get_template_directory() . '/library/admin/widgets/widget_about.php';
require get_template_directory() . '/library/admin/widgets/widget_recent_post.php';
require get_template_directory() . '/library/admin/widgets/related_producer.php';

/* Widgets */
require get_template_directory() . '/library/admin/s3_upload/s3-uploads.php';

/* Taxonomy featured image  */
require get_template_directory() . '/library/admin/taxonomies/tax_cabin_style.php';
require get_template_directory() . '/library/admin/taxonomies/tax_cabin_type.php';
require get_template_directory() . '/library/admin/taxonomies/tax_cabin_amenities.php';

require get_template_directory() . '/library/admin/taxonomies/WDS_Taxonomy_Radio.class.php';

/* TGM Plugin Bind */
//require get_template_directory() . '/library/admin/tgm/class-tgm-plugin-activation.php';
//require get_template_directory() . '/library/admin/tgm/tgm_config.php';

/* Producer metabox */
require get_template_directory() . '/library/admin/cpt/cabin_producer_metabox.php';

require get_template_directory() . '/library/admin/options/theme_dashboard.php';
require get_template_directory() . '/library/admin/functions.php';
require get_template_directory() . '/library/admin/admin_functions.php';

/* Create tables if needed  */
require get_template_directory() . '/library/admin/database/create_tables.php';

?>
