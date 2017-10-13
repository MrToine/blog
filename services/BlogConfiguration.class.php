<?php
/*##################################################
 *                        BlogConfig.class.php
 *                            -------------------
 *   begin                : October 13, 2017
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

class BlogConfiguration {

	private $_display_left_column,
			$_display_right_column,
			$_display_top_menu,
			$_nb_blogs_per_user,
			$_display_blogss,
			$_style_for_blog,
			$_menu_for_blog;

	public function get_display_left_column(){
		return $this->_display_left_column;
	}

	public function get_display_right_column(){
		return $this->_display_right_column;
	}

	public function get_display_top_menu(){
		return $this->_display_top_menu;
	}

	public function get_nb_blogs_per_user(){
		return $this->_nb_blogs_per_user;
	}

	public function get_display_blogs(){
		return $this->_display_blogss;
	}

	public function get_style_for_blog(){
		return $this->_style_for_blog;
	}

	public function get_menu_for_blog(){
		return $this->_menu_for_blog;
	}

	public function set_display_left_column($display_left_column){
		$display_left_column = (int) $display_left_column;

		$this->_display_left_column = $display_left_column;
	}

	public function set_display_right_column($display_right_column){
		$display_right_column = (int) $display_right_column;

		$this->_display_right_column = $display_right_column;
	}

	public function set_display_top_menu($display_top_menu){
		$display_top_menu = (int) $display_top_menu;

		$this->_display_top_menu = $display_top_menu;
	}

	public function set_nb_blogs_per_user($nb_blogs_per_user){
		$nb_blogs_per_user = (int) $nb_blogs_per_user;

		$this->_nb_blogs_per_user = $nb_blogs_per_user;
	}

	public function set_display_blogs($display_blogs){
		$this->_display_blogs = $display_blogs;
	}

	public function set_style_for_blog($style_for_blog){
		$style_for_blog = (int) $style_for_blog;

		$this->_style_for_blog = $style_for_blog;
	}

	public function set_menu_for_blog($menu_for_blog){
		$menu_for_blog = (int) $menu_for_blog;

		$this->_menu_for_blog = $menu_for_blog;
	}

	public function get_properties(){
		return array(
			'display_left_column' => $this->get_display_left_column(),
			'display_right_column' => $this->get_display_right_column(),
			'display_top_menu' => $this->get_display_top_menu(),
			'nb_blogs_per_user' => $this->get_nb_blogs_per_user(),
			'display_blogs' => $this->get_display_blogs(),
			'style_for_blog' => $this->get_style_for_blog(),
			'menu_for_blog' => $this->get_menu_for_blog()
		);
	}

	public function set_properties(array $properties){
		$this->_display_left_column = $properties['display_left_column'];
		$this->_display_right_column = $properties['display_right_column'];
		$this->_display_top_menu = $properties['display_top_menu'];
		$this->_nb_blogs_per_user = $properties['nb_blogs_per_user'];
		$this->_display_blogs = $properties['display_blogs'];
		$this->_style_for_blog = $properties['style_for_blog'];
		$this->_menu_for_blog = $properties['menu_for_blog'];
	}

	public function msession_get_array_tpl_vars(){
		return array(
			'DISPLAY_LEFT_COLUMN' => $this->_display_left_column, 
			'DISPLAY_RIGHT_COLUMN' => $this->_display_right_column,
			'DISPLAY_TOP_MENU' => $this->_display_top_menu,
			'nb_blogs_PER_USER' => $this->_nb_blogs_per_user,
			'DISPLAY_BLOGS' => $this->_display_blogs,
			'STYLE_FOR_BLOG' => $this->_style_for_blog,
			'MENU_FOR_BLOG' => $this->_menu_for_blog,
		);	
	}
}