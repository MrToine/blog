<?php
/*##################################################
 *                                 BlogListController.class.php
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

class BlogListController extends ModuleController {
	
	private $view,
			$lang;

	public function execute(HTTPRequestCustom $request)
	{
		$this->init();

		$config = BlogService::get_config();
		
		$result = PersistenceContext::get_querier()->select('SELECT * FROM '.PREFIX.'blog JOIN '.DB_TABLE_MEMBER.' ON '.DB_TABLE_MEMBER.'.user_id = '.PREFIX.'blog.author_id');

		while ($row = $result->fetch())
		{

			$blog = new Blog();
			$blog->set_properties($row);

			$this->view->assign_block_vars('blog', $blog->get_array_tpl_vars(), array(
				'CREATED' => $blog->get_created()->get_timestamp(),
				'LINK_BLOG_USER'=> BlogUrlBuilder::blog_user($blog->get_id())->absolute(),
				'USERNAME' => $row['display_name'],
				'LINK_USER_PROFILE'=> UserUrlBuilder::profile($row['user_id'])->absolute(),
				'USER_ID'=> $row['user_id'],
				'USER_LEVEL_CLASS'=> UserService::get_level_class($row['level'])
			));

		}
		
		$result->dispose();

		if($config->get_display_blogs() == 1){
			$display_bloc = True;
		}else{
			$display_bloc = False;
		}

		$this->view->put_all(array(
				'HEAD_USER' => $this->lang['head_user'],
				'HEAD_NAME' => $this->lang['head_name'],
				'HEAD_CREATED' => $this->lang['head_created'],
				'DISPLAY_BLOC' => $display_bloc
			));

		return $this->generate_response();
	}
	
	private function init()
	{
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/BlogListController.tpl');
		$this->view->add_lang($this->lang);
	}
	
	private function generate_response()
	{
		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], BlogUrlBuilder::home()->rel());
		$breadcrumb->add($this->lang['list_blog']);
		
		return $response;
	}
}