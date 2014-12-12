<?php
/*##################################################
 *                            Blog.class.php
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

class Blog {

	private $_id,
			$_user_id,
			$_name,
			$_description,
			$_created,
			$_approved;

	public function get_id(){

		return $this->_id;

	}

	public function get_user_id(){

		return $this->_user_id;

	}

	public function get_name(){

		return $this->_name;
		
	}

	public function get_desccription(){

		return $this->_description;
		
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

	public function set_user_id($user_id){

		$user_id = (int) $user_id;

		if($user_id > 0){

			$this->_user_id = $user_id;

		}

	}

	public function set_name($name){

		if(is_string($name)){

			$this->_name = htmlspecialchars($name);

		}

	}

	public function set_description($description){

		$this->_description = htmlspecialchars($description);

	}

	public function set_created($created){

		$created = (int) $created;

		if($created > 0){

			$this->_created = date('d/m/Y', $created);

		}

	}

	public function set_approved($approved){

		$approved = (int) $approved;

		if($approved == 0 || $approved == 1){

			$this->_approved = $approved;

		}

	}

	public function is_authorized_edit()
	{
		return BlogAuthorizationsService::check_authorizations()->moderation() || (BlogAuthorizationsService::check_authorizations()->write() && $this->get_author_user()->get_id() == AppContext::get_current_user()->get_id() && AppContext::get_current_user()->check_level(User::MEMBER_LEVEL));
	}

	public function get_properties()
	{
		return array(
			'id' => $this->get_id(),
			'user_id' => $this->get_user_id(),
			'name' => TextHelper::htmlspecialchars($this->get_name()),
			'description' => TextHelper::htmlspecialchars($this->get_description()),
			'created' => TextHelper::htmlspecialchars($this->get_created()),
			'approved' => TextHelper::htmlspecialchars($this->get_approved())
		);
	}
	
	public function set_properties(array $properties)
	{
		$this->_id = $properties['id'];
		$this->_user_id = $properties['author_id'];
		$this->_name = $properties['name'];
		$this->_description = $properties['description'];
		$this->_created = $properties['created'];
		$this->_approved = $properties['approved'];
	}

	public function get_array_tpl_vars()
	{

		return array(
			'C_EDIT' => $this->is_authorized_edit(),
			'ID' => $this->_id,
			'USER_ID' => $this->_user_id,
			'NAME' => $this->_name,
			'DESCRIPTION' => $this->_description,
			'CREATED' => date('d/m/Y', $this->_created),
			'APPROVED' => $this->_approved,
		);
	}

}