<?php
/*##################################################
 *                                 BlogUserController.class.php
 *                            -------------------
 *   begin                : November 02, 2014
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

class BlogUserController extends ModuleController {
	
	private $view,
			$blog_name,
			$blog_id,
			$lang, 
			$user;
	
	public function execute(HTTPRequestCustom $request)
	{

		$this->blog_id = $request->get_getint('user_id');
		$this->blog_name = $this->get_blog()->get_name();

		$this->init();

		$this->user = AppContext::get_current_user();

		$result = PersistenceContext::get_querier()->select('SELECT * FROM '.PREFIX.'blog_articles JOIN '.DB_TABLE_MEMBER.' ON '.DB_TABLE_MEMBER.'.user_id = '.PREFIX.'blog_articles.author_id WHERE blog_id=:id',
			array('id' => $this->blog_id)
		);

		while ($row = $result->fetch())
		{

			$blog = new BlogUser();
			$blog->set_properties($row);
			
			$this->view->assign_block_vars('blogUserPost', $blog->get_array_tpl_vars());

			if($this->user->get_id() == $blog->get_author_id()){
				$this->view->put('IS_AUTHOR_BLOG', True);
			}

			$this->view->put_all(array(
				'BLOG_NAME' => $this->blog_name,
				'USER' => $row['display_name'],
				'LINK_USER_PROFILE' => UserUrlBuilder::profile($row['user_id'])->absolute(),
				'MANAGE_BLOG_LINK' => BlogUrlBuilder::manage_blog($blog->get_blog_id())->absolute(),
				'MANAGE_NEWS_LINK' => BlogUrlBuilder::manage_news($blog->get_blog_id())->absolute(),
				'CREATE_POST_LINK' => BlogUrlBuilder::create_post($blog->get_blog_id())->absolute(),
				'USER_ID' => $row['user_id'],
				'USER_LEVEL_CLASS' => UserService::get_level_class($row['level']),

			));

		}
		
		$result->dispose();

		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/BlogUserController.tpl');
		$this->view->add_lang($this->lang);
	}

	private function get_blog(){

		$this->blog = BlogService::get_blog($this->blog_id);

		return $this->blog;

	}

	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);

		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], BlogUrlBuilder::home()->rel());
		$breadcrumb->add($this->blog_name, 'LIEN BLOG');
		
		return $response;
	}
}