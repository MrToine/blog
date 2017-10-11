<?php
/*##################################################
 *                        BlogService.class.php
 *                            -------------------
 *   begin                : November 04, 2014
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

class BlogService
{
	private static $db_querier;
	private static $blog_manager;
	
	public static function __static()
	{
		self::$db_querier = PersistenceContext::get_querier();
	}
	
	public static function test($var, $bool = false){
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
		if($bool){
			die();
		}
	}

	public static function create_blog(Blog $blog){
		$result = self::$db_querier->insert(PREFIX.'blog', $blog->get_properties());
		return $result->get_last_inserted_id();
	}

	public static function get_blog($blog_id)
	{

		$row = self::$db_querier->select_single_row_query('SELECT * FROM '.PREFIX.'blog WHERE id=:id', array('id' => $blog_id));
		
		$blog = new Blog();
		$blog->set_properties($row);

		return $blog;
	}

	public static function get_blog_articles($post_slug) {

		$result = self::$db_querier->select_single_row_query('SELECT * FROM '.PREFIX.'blog_articles JOIN '.DB_TABLE_MEMBER.' ON '.DB_TABLE_MEMBER.'.user_id = '.PREFIX.'blog_articles.author_id WHERE '.PREFIX.'blog_articles.slug=:slug', array('slug' => $post_slug));

		return $result;

	}

	public static function user_blog_exist($user_id){
		try {
				$find = self::$db_querier->get_column_value(PREFIX.'blog', 'COUNT(*)', 'WHERE author_id = :author_id', array('author_id' => $user_id));
			} catch (RowNotFoundException $e) {}

		return $find;
	}

}
?>