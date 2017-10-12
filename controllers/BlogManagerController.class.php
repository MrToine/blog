<?php
/*##################################################
 *                           CreatorManageBlog.class.php
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

class BlogManagerController extends ModuleController {

	/* EN PLEIN AMENAGEMENT */

	private $view,
			$blog_name,
			$blog_id,
			$blog_author_id,
			$lang,
			$user;
	
	public function execute(HTTPRequestCustom $request){

		$this->blog_id = $request->get_getint('blog_id');

		$this->init();

		$this->user = AppContext::get_current_user();

		$this->blog_author_id = BlogService::get_blog($this->blog_id)->get_author_id();

		BlogService::test($this->blog_author_id);
		BlogService::test($this->user->get_id());

		if($this->user->get_id() == $this->blog_author_id){
			$this->view->put('IS_AUTHOR_BLOG', True);
		}else{
			die('pas ton blog');
		}
		
		$result = PersistenceContext::get_querier()->count(PREFIX.'blog', 'WHERE author_id=:user_id', array(
			'user_id' => $this->user->get_id()
		));

		$result = (int) $result;

		/* On compte le nombre d'articles dans le blog de l'uilisateur
		if($result > 0){
			$this->view->put('C_RESULT', True);
		}else{
			$this->view->put('C_RESULT', False);
		}*/

		$this->view->put_all(array(
			'CREATE_POST_LINK' => BlogUrlBuilder::create_post($this->blog_id)->absolute(),
			'MANAGER_POSTS_LINK' => BlogUrlBuilder::manage_posts($this->blog_id)->absolute(),
		));

		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/BlogManagerController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);
		
		return $response;
	}

}