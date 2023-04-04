<?php
namespace Starter;

load_theme_textdomain('starter', get_template_directory() . '/languages');

require 'functions/admin.php';
require 'functions/api.php';
require 'functions/editor.php';
require 'functions/excerpt.php';
require 'functions/general.php';
require 'functions/menus.php';
require 'functions/postTypes/blog.php';
require 'functions/postTypes/page.php';
require 'functions/users.php';

// Disable xmlrpc.php
add_filter('xmlrpc_enabled', '__return_false');
if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) )
    exit;