
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

	/* EN PLEIN AMENAGEMENT */

	private $view,
			$blog_name,
			$blog_id,
			$lang;
	
	public function execute(HTTPRequestCustom $request){

		$this->init();

		$user = AppContext::get_current_user();
		if($user->check_level(User::MEMBER_LEVEL)){
			$this->view->put_all(array('USER_CONNECTED' => True));
		}else{
			$this->view->put_all(array('USER_CONNECTED' => False));
		}

		$form = $this->build_form();

		if ($this->submit_button->has_been_submited())
		{
			if ($form->validate())
			{

				die('ok');
			}
		}

		$this->view->put('form', $form->display());

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
			'maxlength' => 25, 'description' => $this->lang['creator.blog_name_desc'], 'required' => true)
		));

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
		
		return $response;
	}

}