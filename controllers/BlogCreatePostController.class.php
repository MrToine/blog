<?php
/*##################################################
 *                           BlogCreatePostController.class.php
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

class BlogCreatePostController extends ModuleController {

	private $lang,
			$view,
			$blog_id,
			$blog,
			$user,
			$post;

	public function execute(HTTPRequestCustom $request){

		$this->blog_id = $request->get_getint('blog_id');
		$this->init();

		$this->user = AppContext::get_current_user();

		$this->blog = BlogService::get_blog($this->blog_id);

		if($this->blog->get_author_id() == $this->user->get_id()){
			$this->view->put('IS_AUTHOR_BLOG', True);
		}

		$form = $this->build_form();

		if($this->submit_button->has_been_submited()){
			if($form->validate()){
				if($form->get_value('publied') == True){
					$approved = 1;
				}else{
					$approved = 0;
				}
				PersistenceContext::get_querier()->insert(PREFIX.'blog_articles', array(
				    'blog_id' => $this->blog_id,
					'author_id' => $this->user->get_id(),
					'name' => $form->get_value('title'),
					'slug' => BlogService::generate_slug($form->get_value('title')),
					'content' => $form->get_value('content'),
					'created' => time(),
					'updated' => time(),
					'approved' => $approved
				));
				$this->view->put('FORM_OK', True);
			}
		}

		$this->view->put('form', $form->display());

		return $this->generate_response();
	}

	private function init(){
		$this->lang = LangLoader::get('common', 'blog');
		$this->view = new FileTemplate('blog/BlogCreatePostController.tpl');
		$this->view->add_lang($this->lang);
	}

	private function build_form(){

		$form = new HTMLForm('CreatePostForm');

		$fieldset = new FormFieldsetHTML('fieldset', 'Créer un billet');
		$form->add_fieldset($fieldset);

		$fieldset->add_field(new FormFieldTextEditor('title', $this->lang['manager.form.title'], '', array(
			'maxlength' => 255,
			'description' => $this->lang['manager.form.title_desc'],
			'required' => True
		)));

		$fieldset->add_field(new FormFieldCheckbox('publied', $this->lang['manager.form.publied'], FormFieldCheckbox::CHECKED));
		$fieldset->add_field(new FormFieldRichTextEditor('content', $this->lang['manager.form.content'], '', array(
			'required' => True
		)));

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
		$breadcrumb->add($this->blog->get_name());
		$breadcrumb->add($this->lang['manager_blog'], BlogUrlBuilder::manage_blog($this->blog_id)->rel());
		$breadcrumb->add($this->lang['add_post']);

		return $response;
	}
}