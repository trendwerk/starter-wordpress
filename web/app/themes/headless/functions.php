<?php
namespace Headless;

load_theme_textdomain('headless', get_template_directory() . '/languages');

require 'functions/admin.php';
require 'functions/api.php';
require 'functions/editor.php';
require 'functions/excerpt.php';
require 'functions/general.php';
require 'functions/menus.php';
require 'functions/postTypes/blog.php';
require 'functions/postTypes/page.php';
