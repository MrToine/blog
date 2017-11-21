<?php
/*##################################################
 *                                 BlogPostController.class.php
 *                            -------------------
 *   begin                : November 07, 2014
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

class BlogPostController extends ModuleController {
	
	private $view,
			$blog_name,
			$blog_post,
			$post,
			$lang,
			$user;
	
	public function execute(HTTPRequestCustom $request)
	{

		$this->blog_post = $request->get_getstring('post_slug');
		

		$this->init();

		$this->user = AppContext::get_current_user();

		$result = BlogService::get_blog_articles($this->blog_post);
		$this->post = new BlogUser();
		$this->post->set_properties($result);
		$this->blog_name = BlogService::get_blog($this->post->get_blog_id())->get_name();

		/* Comments */ 
		$comments_topic = new BlogCommentsTopic();
		$comments_topic->set_id_in_module($this->post->get_id());
		$comments_topic->set_url(BlogUrlBuilder::display_comments_posts($this->post->get_slug()));

		if($this->user->get_id() == $this->post->get_author_id()){
			$this->view->put('IS_AUTHOR_BLOG', True);
		}

		$this->view->put_all(array(
				'ID' => $this->post->get_id(),
				'NAME' => $this->post->get_name(),
				'SLUG' => $this->post->get_slug(),
				'CONTENT' => $this->post->get_content(),
				'CREATED' => date('d/m/Y', $this->post->get_created()),
				'APPROVED' => $this->post->get_approved(),

				'USER' => $result['display_name'],
				'LINK_USER_PROFILE' => UserUrlBuilder::profile($result['user_id'])->absolute(),
				'MANAGE_BLOG_LINK' => BlogUrlBuilder::manage_blog($this->post->get_blog_id())->absolute(),
				'MANAGE_NEWS_LINK' => BlogUrlBuilder::manage_posts($this->post->get_blog_id())->absolute(),
				'CREATE_POST_LINK' => BlogUrlBuilder::create_post($this->post->get_blog_id())->absolute(),
				'USER_ID' => $result['user_id'],
				'USER_LEVEL_CLASS' => UserService::get_level_class($result['level']),
				'COMMENTS' => $comments_topic->display(),
				'NB_COMMENTS' => BlogService::count_comments($this->post->get_id())

		));

		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/BlogPostController.tpl');
		$this->view->add_lang($this->lang);
	}

	private function get_blog(){

		$this->blog = BlogService::get_blog($this->blog_post);

		return $this->blog;

	}
	
	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);

		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], BlogUrlBuilder::home()->rel());
		$breadcrumb->add($this->blog_name, BlogUrlBuilder::blog_user($this->post->get_author_id())->rel());
		$breadcrumb->add($this->post->get_name());
		
		return $response;
	}
}