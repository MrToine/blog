<?php
/*##################################################
 *                                 index.php
 *                            -------------------
 *   begin                : October, 2014
 *   copyright            : (C) 2014 Anthony VIOLET
 *   email                : anthony.violet@outlook.fr
 *
 *
 ###################################################
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 ###################################################*/
 
define('PATH_TO_ROOT', '..');
 
require_once PATH_TO_ROOT . '/kernel/init.php';

//Supprime les menus.
$config = BlogService::get_config();
if(!$config->get_display_left_column()){
ThemesManager::get_theme(AppContext::get_current_user()->get_theme())->get_columns_disabled()->set_disable_left_columns(true);
}
if(!$config->get_display_right_column()){
ThemesManager::get_theme(AppContext::get_current_user()->get_theme())->get_columns_disabled()->set_disable_right_columns(true);
}
if(!$config->get_display_top_menu()){
	ThemesManager::get_theme(AppContext::get_current_user()->get_theme())->get_columns_disabled()->set_disable_top_central(true);
}
 
$url_controller_mappers = array(
	//Admin
	new UrlControllerMapper('AdminConfigBlogController', '`/admin/config`'),
	new UrlControllerMapper('AdminApproveBlogController', '`/admin/manager/approve(?:/([0-9]+))?/?$`', array('blog_id')),
	new UrlControllerMapper('AdminDisapproveBlogController', '`/admin/manager/desapprove(?:/([0-9]+))?/?$`', array('blog_id')),
	new UrlControllerMapper('AdminManagerBlogController', '`/admin/manager`'),

	//Manager
	new UrlControllerMapper('CreatorBlogController', '`/creator`'),
	new UrlControllerMapper('BlogDeletePostController', '`(?:/([0-9]+))?/manager/delete(?:/([0-9]+))?/?$`', array('blog_id', 'post_id')),
	new UrlControllerMapper('BlogEditPostController', '`(?:/([0-9]+))?/manager/edit(?:/([0-9]+))?/?$`', array('blog_id', 'post_id')),
	new UrlControllerMapper('BlogCreatePostController', '`(?:/([0-9]+))?/manager/create`', array('blog_id')),
	new UrlControllerMapper('BlogPostsManagerController', '`(?:/([0-9]+))?/manager/posts`', array('blog_id')),
	new UrlControllerMapper('BlogManagerController', '`(?:/([0-9]+))?/manager`', array('blog_id')),
	
	//Display
	new UrlControllerMapper('BlogPostController', '`/post(?:/([a-z0-9-_]+))?/?`', array('post_slug')),
	new UrlControllerMapper('BlogUserController', '`/view(?:/([0-9]+))?/?$`', array('user_id')),	
	new UrlControllerMapper('BlogListController', '`/list`'),
	new UrlControllerMapper('BlogController', '`^`'),

);
 
DispatchManager::dispatch($url_controller_mappers);