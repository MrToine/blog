<?php
/*##################################################
 *                    BlogSetup.class.php
 *                            -------------------
 *   begin                : November 01, 2012
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

/**
 * @author Anthony Violet <anthony.violet@outlook.fr>
 */

class BlogSetup extends DefaultModuleSetup
{

	public static $blog_table = array('blog' => 'blog', 'articles' => 'blog_articles');

	private $blog;

	public static function __static(){

		self::$blog_table['blog'] = PREFIX . 'blog';
		self::$blog_table['articles'] = PREFIX . 'blog_articles';

	}

	public function install(){

		$this->drop_tables();
		$this->create_table_blog();
		$this->create_table_articles();
		$this->insert_data();
 
	}
 
	public function uninstall(){
 
		$this->drop_tables();

	}

	public function drop_tables(){

		PersistenceContext::get_dbms_utils()->drop(self::$blog_table['blog']);
		PersistenceContext::get_dbms_utils()->drop(self::$blog_table['articles']);

	}

	public function create_table_blog(){

		$fields_blog = array(
			'id' => array('type' => 'integer', 'length' => 11, 'autoincrement' => true, 'notnull' => 1),
			'author_id' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1),
			'name' => array('type' => 'string', 'length' => 250, 'notnull' => 1, 'default' => "''"),
			'description' => array('type' => 'text', 'length' => 65000),
			'created' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1),
			'approved' => array('type' => 'integer', 'lenght' => 1, 'notnull' => 1, 'default' => 0)
		);
		$options_blog = array(
			'primary' => array('id'),
			'indexes' => array(
				'author_id' => array('type' => 'key', 'fields' => 'author_id'),
				'name' => array('type' => 'fulltext', 'fields' => 'name'),
				'description' => array('type' => 'fulltext', 'fields' => 'description'),
			),
		);

		PersistenceContext::get_dbms_utils()->create_table(self::$blog_table['blog'], $fields_blog, $options_blog);

	}

	public function create_table_articles(){

		$fields_articles = array(
			'id' => array('type' => 'integer', 'length' => 11, 'autoincrement' => true, 'notnull' => 1),
			'blog_id' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1),
			'author_id' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1),
			'name' => array('type' => 'string', 'length' => 250, 'notnull' => 1, 'default' => "''"),
			'slug' => array('type' => 'string', 'lenght' => 250, 'notnull' => 1),
			'content' => array('type' => 'text', 'length' => 65000),
			'created' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1),
			'updated' => array('type' => 'integer', 'lenght' => 11, 'notnull' => 1),
			'approved' => array('type' => 'integer', 'lenght' => 1, 'notnull' => 1, 'default' => 0)
		);
		$options_articles = array(
			'primary' => array('id'),
			'indexes' => array(
				'blog_id' => array('type' => 'key', 'fields' => 'blog_id'),
				'author_id' => array('type' => 'key', 'fields' => 'author_id'),
				'name' => array('type' => 'fulltext', 'fields' => 'name'),
				'slug' => array('type' => 'fulltext', 'fields' => 'slug'),
				'content' => array('type' => 'fulltext', 'fields' => 'content'),
			),
		);

		PersistenceContext::get_dbms_utils()->create_table(self::$blog_table['articles'], $fields_articles, $options_articles);

	}

	private function insert_data(){

		$this->blog = LangLoader::get('install', 'blog');

        PersistenceContext::get_querier()->insert(self::$blog_table['blog'], array(
			'id' => 1,
			'author_id' => 1,
			'name' => $this->blog['blog.blog_name'],
			'description' => $this->blog['blog.blog_description'],
			'created' => time(),
			'approved' => 1,
		));
	}

}