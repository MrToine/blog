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

	public static $blog_table = array();

	private $blog;

	public static function __static(){

		self::$blog_table['blog'] = PREFIX.'blog';
		self::$blog_table['articles'] = PREFIX.'blog_articles';
		self::$blog_table['config'] = PREFIX.'blog_config';

	}

	public function install(){

		$this->drop_tables();
		$this->create_table_blog();
		$this->create_table_articles();
		$this->create_table_config();
		$this->insert_data();
 
	}
 
	public function uninstall(){
 
		$this->drop_tables();

	}

	public function drop_tables(){

		PersistenceContext::get_dbms_utils()->drop(self::$blog_table['blog']);
		PersistenceContext::get_dbms_utils()->drop(self::$blog_table['articles']);
		PersistenceContext::get_dbms_utils()->drop(self::$blog_table['config']);

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

	public function create_table_config(){
		$fields_config = array(
			'display_left_column' => array(
				'type' => 'integer', 
				'length' => 1, 
				'notnull' => 1,
				'default' => 0
			),
			'display_right_column' => array(
				'type' => 'integer', 
				'lenght' => 1, 
				'notnull' => 1,
				'default' => 0
			),
			'display_top_menu' => array(
				'type' => 'integer', 
				'lenght' => 1, 
				'notnull' => 1,
				'default' => 0
			),
			'nb_blog_per_user' => array(
				'type' => 'integer',
				'lenght' => 5,
				'notnull' => 1,
				'default' => 1
			),
			'display_blogs' => array(
				'type' => 'string',
				'lenght' => 11,
				'notnull' => 11,
				'default' => "'bloc'"
			),
			'style_for_blog' => array(
				'type' => 'integer',
				'lenght' => 1,
				'notnull' => 1,
				'default' => 1
			),
			'menu_for_blog' => array(
				'type' => 'integer',
				'lenght' => 1,
				'notnull' => 1,
				'default' => 0
			),
		);

		PersistenceContext::get_dbms_utils()->create_table(self::$blog_table['config'], $fields_config);

	}

	private function insert_data(){

		$this->blog = LangLoader::get('install', 'blog');

        PersistenceContext::get_querier()->insert(self::$blog_table['blog'], array(
			'id' => 1,
			'author_id' => 1,
			'name' => $this->blog['blog.name'],
			'description' => $this->blog['blog.description'],
			'created' => time(),
			'approved' => 1,
		));

		PersistenceContext::get_querier()->insert(self::$blog_table['articles'], array(
			'id' => 1,
			'blog_id' => 1,
			'author_id' => 1,
			'name' => $this->blog['post.title'],
			'slug' => $this->blog['post.slug'],
			'content' => $this->blog['post.content'],
			'created' => time(),
			'updated' => time(),
			'approved' => 1
		));
	}

}