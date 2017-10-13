<?php
/*##################################################
 *                           BlogCreatePostController.class.php
 *                            -------------------
 *   begin                : November 17, 2014
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

class BlogDeletePostController extends ModuleController {

	private $lang,
			$view,
			$blog_author_id,
			$user,
			$blog_id,
			$post_id;

	public function execute(HTTPRequestCustom $request){

		/*
			EN COURS D'AMENAGEMENT.

			Système à repenser. Pour le moment, le membre supprime son billet sans message d'avertissement.
			A changer...
		*/

		$this->blog_id = $request->get_getint('blog_id');
		$this->post_id = $request->get_getint('post_id');
		$this->init();

		$this->user = AppContext::get_current_user();

		$this->blog_author_id = BlogService::get_blog($this->blog_id)->get_author_id();

		if($this->blog_author_id == $this->user->get_id()){
			$this->view->put('IS_AUTHOR_BLOG', True);
		}

		BlogService::delete_post('WHERE id=:id', array('id' => $this->post_id));
		AppContext::get_response()->redirect(BlogUrlBuilder::manage_posts($this->blog_id)->absolute());

		return $this->generate_response();
	}

	private function init(){
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/BlogDeletePostController.tpl');
		$this->view->add_lang($this->lang);
	}

	private function generate_response(){
		$modulesLoader = AppContext::get_extension_provider_service();
		$module = $modulesLoader->get_provider('blog');

		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);

		return $response;
	}
}