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
	
	public static function get_blog($blog_id)
	{

		$row = self::$db_querier->select_single_row_query('SELECT * FROM '.PREFIX.'blog WHERE id=:id', array('id' => $blog_id));
		
		$blog = new Blog();
		$blog->set_properties($row);

		return $blog;
	}

	public static function get_blog_articles($post_slug) {

		$result = PersistenceContext::get_querier()->select_single_row_query('SELECT blog_articles.*, member.*
		FROM '.PREFIX.'blog_articles blog_articles
		LEFT JOIN '.DB_TABLE_MEMBER.' member ON member.user_id = blog_articles.author_id WHERE blog_articles.slug = :slug', array('slug' => $post_slug));

		return $result;

	}

}
?>