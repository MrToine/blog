
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
		$form_style = $this->build_form_style();
		$form_autorisations = $this->build_form_autorisations();

		$this->view->put_all(array(
			'form_config' => $form_config->display(),
			'form_style' => $form_style->display(),
			'form_autorisations' => $form_autorisations->display()
		));

		return new AdminBlogDisplayResponse($this->view, $this->lang['config.module.configuration']);
	}

	private function build_form_config(){
		$form = new HTMLForm('AdminConfigModuleBlog');

		$fieldset = new FormFieldsetHTML('fieldset', 'Générale');
		$form->add_fieldset($fieldset);
		
		$fieldset->add_field(new FormFieldCheckbox('left_columns', $this->lang['config.form.left_column'], $this->config->get_display_left_column()));
		$fieldset->add_field(new FormFieldCheckbox('right_columns', $this->lang['config.form.right_column'],$this->config->get_display_right_column()));
		$fieldset->add_field(new FormFieldCheckbox('top_menu', $this->lang['config.form.top_menu'], $this->config->get_display_top_menu()));
		$fieldset->add_field(new FormFieldNumberEditor('number_blogs_per_user', $this->lang['config.form.nb_blogs_per_user'], $this->config->get_nb_blog_per_user(), array(
			'min' => 1, 'max' => 5, 'description' => ''),
			array(new FormFieldConstraintIntegerRange(1, 5))
		));

		return $form;
	}

	private function build_form_style(){
		$form = new HTMLForm('AdminStyleModuleBlog');

		$fieldset = new FormFieldsetHTML('fieldset', 'Style des Blogs');
		$form->add_fieldset($fieldset);
		$fieldset->add_field(new FormFieldSimpleSelectChoice('bloc_or_list', $this->lang['config.form.bloc_or_list'], '',
		array(
			if($this->config->get_display_blogs() == "bloc"){
				new FormFieldSelectChoiceOption($this->lang['config.form.list'], 'list'),
				new FormFieldSelectChoiceOption($this->lang['config.form.bloc'], 'bloc')
			}else{
				new FormFieldSelectChoiceOption($this->lang['config.form.list'], 'bloc'),
				new FormFieldSelectChoiceOption($this->lang['config.form.bloc'], 'list')
			}
		)));
		$fieldset->add_field(new FormFieldCheckbox('blog_style', $this->lang['config.form.blog_style'],''));
		$fieldset->add_field(new FormFieldCheckbox('blog_menu', $this->lang['config.form.blog_menu'], ''));

		return $form;
	}

	private function build_form_autorisations(){
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

		return $form;
	}

	private function init(){
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/admin/AdminConfigBlogController.tpl');
		$this->view->add_lang($this->lang);
	}
}