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

class BlogPostsManagerController extends ModuleController {

	

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
		$this->blog_name = BlogService::get_blog($this->blog_id)->get_name();

		if($this->user->get_id() == $this->blog_author_id){
			$this->view->put('IS_AUTHOR_BLOG', True);
		}

		$result = PersistenceContext::get_querier()->select('SELECT * FROM '.PREFIX.'blog_articles JOIN '.DB_TABLE_MEMBER.' ON '.DB_TABLE_MEMBER.'.user_id = '.PREFIX.'blog_articles.author_id WHERE blog_id=:id',
			array('id' => $this->blog_id)
		);

		while ($row = $result->fetch())
		{

			$post = new BlogUser();
			$post->set_properties($row);
			
			if($post->get_approved() == 1){
				$state = $this->lang['state.post.publied'];
				$icon_fa = 'fa-check';
			}else{
				$state = $this->lang['state.post.nopublied'];
				$icon_fa = 'fa-ban';
			}

			$this->view->assign_block_vars('post', $post->get_array_tpl_vars(), array(
				'STATE' => $state,
				'ICON' => $icon_fa,
				'EDIT_POST_LINK' => BlogUrlBuilder::edit_post($this->blog_id, $post->get_id())->absolute(),
				'DELETE_POST_LINK' => BlogUrlBuilder::delete_post($this->blog_id, $post->get_id())->absolute()
			));

		}

		$this->view->put('CREATE_POST_LINK', BlogUrlBuilder::create_post($this->blog_id)->absolute());

		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/BlogPostsManagerController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);

		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], BlogUrlBuilder::home()->rel());
		$breadcrumb->add($this->blog_name, BlogUrlBuilder::blog_user($this->blog_author_id));
		$breadcrumb->add($this->lang['manager_blog'], BlogUrlBuilder::manage_blog($this->blog_id)->rel());
		$breadcrumb->add($this->lang['list_posts']);

		return $response;
	}

}