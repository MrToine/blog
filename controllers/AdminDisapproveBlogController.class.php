<?php
/*##################################################
 *                           AdminDisapproveBlogController.class.php
 *                            -------------------
 *   begin                : October 20, 2017
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

class AdminDisapproveBlogController extends AdminModuleController {

	private $view,
			$lang;

	public function execute(HTTPRequestCustom $request){

		$blog_id = $request->get_getint('blog_id');

		$actual_blog = BlogService::get_blog($blog_id);

		$updated_blog = new Blog();
		$updated_blog->set_properties(array(
			'id' => $blog_id,
			'author_id' => $actual_blog->get_author_id(),
			'name' => $actual_blog->get_name(),
			'about' => $actual_blog->get_about(),
			'description' => $actual_blog->get_description(),
			'created' => time(),
			'approved' => 0
		));
		BlogService::test($updated_blog);
		BlogService::update_blog($updated_blog);

		AppContext::get_response()->redirect(BlogUrlBuilder::config_manager_module()->absolute());

		
	}
}