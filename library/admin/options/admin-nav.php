<?php
$active_page = 'gdmp';
	if($_REQUEST['page'] && !empty($_REQUEST['page']) ){
		$active_page = $_REQUEST['page'];
	}

$gdmp_admin_nav = array(
					array(
						'nav_text' => __('Filter Slider Settings', 'hytteguiden'),
						'nav_link' => admin_url( 'admin.php?page=hytte_dashboard'),
						'nav_class' => ($active_page == 'hytte_dashboard' ? 'nav-tab  nav-tab-active' : 'nav-tab'),
					),
					array(
						'nav_text' => __('Template Endpoints', 'hytteguiden'),
						'nav_link' => admin_url( 'admin.php?page=tpl_endpoints'),
						'nav_class' => ($active_page == 'tpl_endpoints' ? 'nav-tab  nav-tab-active' : 'nav-tab'),
					),
					array(
						'nav_text' => __('Hytte Kontakt', 'hytteguiden'),
						'nav_link' => admin_url( 'admin.php?page=cabin_contact_list'),
						'nav_class' => ($active_page == 'cabin_contact_list' ? 'nav-tab  nav-tab-active' : 'nav-tab'),
					),
					array(
						'nav_text' => __('Kataloger Bestilling', 'hytteguiden'),
						'nav_link' => admin_url( 'admin.php?page=kataloger_contact_list'),
						'nav_class' => ($active_page == 'kataloger_contact_list' ? 'nav-tab  nav-tab-active' : 'nav-tab'),
                    ),
                    array(
						'nav_text' => __('Advanced Settings', 'gdmp'),
						'nav_link' => admin_url( 'admin.php?page=hytte_map_slug'),
						'nav_class' => ($active_page == 'hytte_map_slug' ? 'nav-tab  nav-tab-active' : 'nav-tab'),
					)
			);



			if($gdmp_admin_nav){
					echo '<h2 class="nav-tab-wrapper">';
				foreach ($gdmp_admin_nav as $admin_nav) {

						echo '<a href="'.$admin_nav['nav_link'].'" class="'.$admin_nav['nav_class'].'">'.$admin_nav['nav_text'].'</a>';
				}
				echo '</h2>';
			}

?>
