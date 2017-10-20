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

class CreatorBlogController extends ModuleController {

	private $view,
			$blog_name,
			$blog_id,
			$lang,
			$user, 
			$blog;
	
	public function execute(HTTPRequestCustom $request){

		$this->init();

		$this->user = AppContext::get_current_user();
		$config = BlogService::get_config();
		if($this->user->check_level(User::MEMBER_LEVEL)){
			$this->view->put_all(array('USER_CONNECTED' => True));
		}else{
			$this->view->put_all(array('USER_CONNECTED' => False));
		}

		if(BlogService::user_blog_exist($this->user->get_id()) < $config->get_nb_blogs_per_user() ){
			$form = $this->build_form();

			if ($this->submit_button->has_been_submited())
			{
				if ($form->validate())
				{
					$this->blog = new Blog();
					$this->blog->set_name($form->get_value('name'));
					$this->blog->set_about($form->get_value('about'));
					$this->blog->set_description($form->get_value('description'));
					$this->blog->set_author_id($this->user->get_id());
					$this->blog->set_created(new Date());
					$this->blog->set_approved(0);
					BlogService::create_blog($this->blog);

					$alert_create_blog = new AdministratorAlert();
					$alert_create_blog->set_entitled('Création d\'un blog. Cliquez sur ce lien pour approuver ou supprimer cette demande.');
					$alert_create_blog->set_fixing_url('/blog/admin/manager');
					$alert_create_blog->set_priority('ADMIN_ALERT_MEDIUM_PRIORITY');
					$alert_create_blog->set_status('ADMIN_ALERT_STATUS_UNREAD');

					AdministratorAlertService::save_alert($alert_create_blog);
					AppContext::get_response()->redirect(BlogUrlBuilder::manage_blog(BlogService::count_blogs() += 1)->absolute());
				}
			}

			$this->view->put('form', $form->display());
		}else{
			AppContext::get_response()->redirect(BlogUrlBuilder::home()->absolute());
		}

			

		return $this->generate_response();
	}
	
	private function init(){

		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/CreatorBlogManagerController.tpl');
		$this->view->add_lang($this->lang);
	}

	private function build_form(){

		$form = new HTMLForm('CreateBlogForm');

		// FIELDSET
		$fieldset = new FormFieldsetHTML('fieldset', 'Créer mon Blog !');
		$form->add_fieldset($fieldset);
		
		// INFOS
		$fieldset->add_field(new FormFieldTextEditor('name', $this->lang['creator.blog_name'], '', array(
			'maxlength' => 255, 'description' => $this->lang['creator.blog_name_desc'], 'required' => true)
		));
		$fieldset->add_field(new FormFieldRichTextEditor('about', $this->lang['creator.about'], '', array('required' => true)));
		// DESCRIPTION
		$fieldset->add_field(new FormFieldRichTextEditor('description', $this->lang['creator.description'], '', array('required' => true)));

		// BUTTONS
		$buttons_fieldset = new FormFieldsetSubmit('buttons');
		$this->submit_button = new FormButtonDefaultSubmit();
		$buttons_fieldset->add_element($this->submit_button);
		$form->add_fieldset($buttons_fieldset);
		
		return $form;
	}
	
	private function generate_response(){

		$response = new SiteDisplayResponse($this->view);
		$graphical_environment = $response->get_graphical_environment();
		$graphical_environment->set_page_title($this->lang['module_title']);

		$breadcrumb = $graphical_environment->get_breadcrumb();
		$breadcrumb->add($this->lang['module_title'], BlogUrlBuilder::home()->rel());
		$breadcrumb->add($this->lang['create_blog'], BlogUrlBuilder::create_blog());
		
		return $response;
	}

}