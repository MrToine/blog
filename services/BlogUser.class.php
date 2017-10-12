<?php
/*##################################################
 *                            BlogUser.class.php
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

class BlogUser {

	private $_id,
			$_blog_id,
			$_author_id,
			$_name,
			$_slug,
			$_content,
			$_created,
			$_approved;

	public function get_id(){

		return $this->_id;

	}

	public function get_blog_id(){

		return $this->_blog_id;

	}

	public function get_author_id(){

		return $this->_author_id;

	}

	public function get_name(){

		return $this->_name;
		
	}

	public function get_slug(){

		return $this->_slug;
		
	}

	public function get_content(){

		return $this->_content;
		
	}

	public function get_created(){

		return $this->_created;
		
	}

	public function get_approved(){

		return $this->_approved;

	}

	public function set_id($id){

		$id = (int) $id;

		if($id > 0){

			$this->_id = $id;

		}

	}

	public function set_blog_id($blog_id){

		$blog_id = (int) $blog_id;

		if($blog_id > 0){

			$this->_blog_id = $blog_id;

		}

	}

	public function set_author_id($author_id){

		$author_id = (int) $author_id;

		if($author_id > 0){

			$this->_author_id = $author_id;

		}

	}

	public function set_name($name){

		if(is_string($name)){

			$this->_name = htmlspecialchars($name);

		}

	}

	public function set_slug($slug){

		if(is_string($slug)){

			$this->_slug = htmlspecialchars($slug);

		}

	}

	public function set_content($content){

		$this->_content = $content;

	}

	public function set_created($created){

		$created = (int) $created;

		if($created > 0){

			$this->_created = date('d/m/Y', $created);

		}

	}

	public function approved($approved){

		$approved = (int) $approved;

		if($approved == 0 || $approved == 1){

			$this->_approved = $approved;

		}

	}

	public function get_properties()
	{
		return array(
			'id' => $this->get_id(),
			'blog_id' => $this->get_blog_id(),
			'author_id' => $this->get_author_id(),
			'name' => TextHelper::htmlspecialchars($this->get_name()),
			'slug' => TextHelper::htmlspecialchars($this->get_slug()),
			'content' => $this->get_content(),
			'created' => TextHelper::htmlspecialchars($this->get_created()),
			'approved' => TextHelper::htmlspecialchars($this->get_approved())
		);
	}
	
	public function set_properties(array $properties)
	{
		$this->_id = $properties['id'];
		$this->_blog_id = $properties['blog_id'];
		$this->_author_id = $properties['author_id'];
		$this->_name = $properties['name'];
		$this->_slug = $properties['slug'];
		$this->_content = $properties['content'];
		$this->_created = $properties['created'];
		$this->_approved = $properties['approved'];
	}

	public function get_array_tpl_vars()
	{	
		return array(
			'ID' => $this->_id,
			'BLOG_ID' => $this->_blog_id,
			'AUTHOR_ID' => $this->_author_id,
			'NAME' => $this->_name,
			'SLUG' => $this->_slug,
			'CONTENT' => FormatingHelper::second_parse($this->_content),
			'SHORT_CONTENT' => substr(@strip_tags($this->_content, '<br>'), 0, 500),
			'CREATED' => date('d/m/Y', $this->_created),
			'APPROVED' => $this->_approved,
		);
	}

}