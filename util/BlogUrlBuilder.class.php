<?php
/*##################################################
 *                            BlogUrlBuilder.class.php
 *                            -------------------
 *   begin                : November 01, 2014
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

class BlogUrlBuilder
{

	const DEFAULT_SORT_FIELD = '';
	const DEFAULT_SORT_MODE = 'desc';
	private static $dispatcher = '/blog';
	
	/**
	 * @return Url
	 */
	public static function home(){

		return DispatchManager::get_url(self::$dispatcher, '/list');
	}

	public static function list(){
		return DispatchManager::get_url(self::$dispatcher, '/list');
	}

	public static function home_site(){

		return DispatchManager::get_url(HOST);
	}

	public static function blog_user($user_id){

		return DispatchManager::get_url(self::$dispatcher, '/'.$user_id);

	}

	public static function blog_post(){

		return DispatchManager::get_url(self::$dispatcher, '/post');

	}

	public static function display_comments_posts($slug_post)
	{
		return DispatchManager::get_url(self::$dispatcher, '/post/'.$slug_post.'/', true);
	}

	// Manager
	public static function create_blog(){

		return DispatchManager::get_url(self::$dispatcher, '/creator');

	}

	public static function manage_blog($blog_id){

		return DispatchManager::get_url(self::$dispatcher, '/'.$blog_id.'/manager/');

	}

	public static function manage_posts($blog_id){

		return DispatchManager::get_url(self::$dispatcher, '/'.$blog_id.'/manager/posts');

	}

	public static function create_post($blog_id){
		return DispatchManager::get_url(self::$dispatcher, '/'.$blog_id.'/manager/create');
	}

	public static function edit_post($blog_id, $post_id){
		return DispatchManager::get_url(self::$dispatcher, '/'.$blog_id.'/manager/edit/'.$post_id);
	}

	public static function delete_post($blog_id, $post_id){
		return DispatchManager::get_url(self::$dispatcher, '/'.$blog_id.'/manager/delete/'.$post_id);
	}
}
?>
