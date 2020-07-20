<?php
wp_redirect(empty($GLOBALS['wp']->request) ? WP_URL : WP_URL . '/' . $GLOBALS['wp']->request);
