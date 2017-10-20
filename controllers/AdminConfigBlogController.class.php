
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

class AdminConfigBlogController extends AdminModuleController {

	private $view,
			$lang,
			$config;

	public function execute(HTTPRequestCustom $request){
		
		$this->init();

		$this->config = BlogService::get_config();
		
		$form_config = $this->build_form_config();
		//$form_autorisations = $this->build_form_authorizations();

		if ($this->submit_button_config->has_been_submited())
		{
			if ($form_config->validate())
			{
				BlogService::update_config(array(
					'display_left_column' => $form_config->get_value('left_columns'), 
					'display_right_column' => $form_config->get_value('right_columns'), 
					'display_top_menu' => $form_config->get_value('top_menu'),
					//'nb_blogs_per_user' => $form_config->get_value('number_blogs_per_user'),
					'display_blogs' => $form_config->get_value('bloc_or_list'), 
					/* PROCHAINE MAJ
					'style_for_blog' => $form_config->get_value('blog_style'), 
					'menu_for_blog' => $form_config->get_value('blog_menu')*/
				));
				$this->view->put_all(array(
					'FORM_OK' => true,
				));
			}
		}

		$this->view->put_all(array(
			'form_config' => $form_config->display(),
			//'form_autorisations' => $form_authorizations->display()
		));

		return new AdminBlogDisplayResponse($this->view, $this->lang['config.module.configuration']);
	}

	private function build_form_config(){
		$form = new HTMLForm('AdminConfigModuleBlog');

		$fieldset = new FormFieldsetHTML('fieldset', 'Configuration');
		$form->add_fieldset($fieldset);
		
		$fieldset->add_field(new FormFieldCheckbox('left_columns', $this->lang['config.form.left_column'], $this->config->get_display_left_column()));
		$fieldset->add_field(new FormFieldCheckbox('right_columns', $this->lang['config.form.right_column'],$this->config->get_display_right_column()));
		$fieldset->add_field(new FormFieldCheckbox('top_menu', $this->lang['config.form.top_menu'], $this->config->get_display_top_menu()));
		/*$fieldset->add_field(new FormFieldNumberEditor('number_blogs_per_user', $this->lang['config.form.nb_blogs_per_user'].'<span style="color:red">(En plein aménagement, ne fonctionne pas.)</span>', $this->config->get_nb_blogs_per_user(), array(
			'min' => 1, 'max' => 5, 'description' => ''),
			array(new FormFieldConstraintIntegerRange(1, 5))
		));*/
		$fieldset->add_field(new FormFieldCheckbox('bloc_or_list', $this->lang['config.form.bloc_or_list'], $this->config->get_display_blogs()));
		/* >>> PROCHAINE MAJ

		$fieldset->add_field(new FormFieldCheckbox('blog_style', $this->lang['config.form.blog_style'],$this->config->get_style_for_blog()));
		$fieldset->add_field(new FormFieldCheckbox('blog_menu', $this->lang['config.form.blog_menu'], $this->config->get_menu_for_blog()));*/

		// BUTTONS
		$buttons_fieldset = new FormFieldsetSubmit('buttons');
		$this->submit_button_config = new FormButtonDefaultSubmit();
		$buttons_fieldset->add_element($this->submit_button_config);
		$form->add_fieldset($buttons_fieldset);

		return $form;
	}

	private function build_form_authorizations(){
		$form = new HTMLForm('AdminAutorisationsModuleBlog');

		$fieldset = new FormFieldsetHTML('fieldset', 'Gestion Autorisations');
		$form->add_fieldset($fieldset);
		
		$fieldset->add_field(new FormFieldCheckbox('left_columns', $this->lang['config.form.left_column'], ''));
		$fieldset->add_field(new FormFieldCheckbox('right_columns', $this->lang['config.form.right_column'],''));
		$fieldset->add_field(new FormFieldCheckbox('top_menu', $this->lang['config.form.top_menu'], ''));
		$fieldset->add_field(new FormFieldNumberEditor('number_blogs_per_user', $this->lang['config.form.nb_blogs_per_user'], 1, array(
			'min' => 1, 'max' => 5, 'description' => ''),
			array(new FormFieldConstraintIntegerRange(1, 5))
		));

		// BUTTONS
		$buttons_fieldset = new FormFieldsetSubmit('buttons');
		$this->submit_button = new FormButtonDefaultSubmit();
		$buttons_fieldset->add_element($this->submit_button);
		$form->add_fieldset($buttons_fieldset);

		return $form;
	}

	private function init(){
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/admin/AdminConfigBlogController.tpl');
		$this->view->add_lang($this->lang);
	}
}