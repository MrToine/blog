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
			$_author_id,
			$_name,
			$_description,
			$_start_date,
			$_end_date,
			$_end_date_enabled,
			$_created,
			$_approved;

	public function get_id(){

		return $this->_id;

	}

	public function get_author_id(){

		return $this->_author_id;

	}

	public function get_name(){

		return $this->_name;
		
	}

	public function get_description(){

		return $this->_description;
		
	}

	public function set_start_date(Date $start_date){

		$this->_start_date = $_start_date;
	}
	
	public function get_start_date(){

		return $this->_start_date;
	}
	
	public function set_end_date(Date $end_date){

		$this->_end_date = $_end_date;
		$this->_end_date_enabled = true;
	}
	
	public function get_end_date(){

		return $this->_end_date;
	}
	
	public function end_date_enabled(){

		return $this->_end_date_enabled;
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

	public function set_description($description){

		$this->_description = htmlspecialchars($description);

	}

	public function set_created(Date $created){

		$this->_created = $created;

	}

	public function set_approved($approved){

		$approved = (int) $approved;

		if($approved == 0 || $approved == 1){

			$this->_approved = $approved;

		}

	}

	public function is_authorized_edit()
	{
		/*return BlogAuthorizationsService::check_authorizations()->moderation() || (BlogAuthorizationsService::check_authorizations()->write() && $this->get_author_user()->get_id() == AppContext::get_current_user()->get_id() && AppContext::get_current_user()->check_level(User::MEMBER_LEVEL));*/
		return BlogAuthorizationsService::check_authorizations()->moderation() || ((BlogAuthorizationsService::check_authorizations()->write() /*|| (BlogAuthorizationsService::check_authorizations()->contribution() && !$this->is_visible()))*/ && $this->get_author_id() == AppContext::get_current_user()->get_id() && AppContext::get_current_user()->check_level(User::MEMBER_LEVEL)));
	}

	public function get_properties()
	{
		return array(
			'id' => $this->get_id(),
			'author_id' => $this->get_author_id(),
			'name' => TextHelper::htmlspecialchars($this->get_name()),
			'description' => TextHelper::htmlspecialchars($this->get_description()),
			'created' => $this->get_created()->get_timestamp(),
			'approved' => TextHelper::htmlspecialchars($this->get_approved())
		);
	}
	
	public function set_properties(array $properties)
	{
		$this->_id = $properties['id'];
		$this->_author_id = $properties['author_id'];
		$this->_name = $properties['name'];
		$this->_description = $properties['description'];
		$this->_created =new Date($properties['created'], Timezone::SERVER_TIMEZONE);
		$this->_approved = $properties['approved'];
	}

	public function get_array_tpl_vars()
	{
		Date::get_array_tpl_vars($this->_created,'date');
		return array(
			'C_EDIT' => $this->is_authorized_edit(),
			'ID' => $this->_id,
			'author_id' => $this->_author_id,
			'NAME' => $this->_name,
			'DESCRIPTION' => $this->_description,
			'CREATED' => $this->get_start_date() != null ? $this->get_start_date()->get_timestamp() : $this->get_created()->get_timestamp(),
			'APPROVED' => $this->_approved,
		);
	}

}