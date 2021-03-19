<?php
wp_redirect(empty($GLOBALS['wp']->request) ? WP_HOME . '/wp/wp-admin/' : SITE_URL . '/' . $GLOBALS['wp']->request);
