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
			$post_name,
			$lang;
	
	public function execute(HTTPRequestCustom $request)
	{

		$this->blog_post = $request->get_getstring('post_slug');
		

		$this->init();

		$result = BlogService::get_blog_articles($this->blog_post);
		$post = new BlogUser();
		$post->set_properties($result);

		/* Comments */ 

		$comments_topic = new BlogCommentsTopic();
		$comments_topic->set_id_in_module($post->get_id());
		$comments_topic->set_url(BlogUrlBuilder::display_comments_posts($post->get_slug()));

		$this->view->put_all(array(
				'ID' => $post->get_id(),
				'NAME' => $post->get_name(),
				'SLUG' => $post->get_slug(),
				'CONTENT' => FormatingHelper::second_parse($post->get_content()),
				'CREATED' => date('d/m/Y', $post->get_created()),
				'APPROVED' => $post->get_approved(),

				'USER' => $result['display_name'],
				'LINK_USER_PROFILE' => UserUrlBuilder::profile($result['user_id'])->absolute(),
				'USER_ID' => $result['user_id'],
				'USER_LEVEL_CLASS' => UserService::get_level_class($result['level']),
				'COMMENTS' => $comments_topic->display()

		));

		$this->post_name = $post->get_name();

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
		$breadcrumb->add($this->blog_name);
		$breadcrumb->add($this->post_name);
		
		return $response;
	}
}