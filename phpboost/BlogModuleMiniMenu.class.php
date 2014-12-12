<?php
/*##################################################
 *                           BlogModuleMiniMenu.class.php
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

class BlogModuleMiniMenu extends ModuleMiniMenu {

	public function get_default_block()
    {
    	return self::BLOCK_POSITION__LEFT;
    }
 
    public function admin_display()
    {
    	
    	return $this->display();
    }
 
    public function display($tpl = false)
    {
    	$tpl = new FileTemplate('blog/blog_mini.tpl');
 
    	// Permet d'assigner les variables tpl au template pour pouvoir ensuite donner un affichage différent selon la colonne où est situé le menu
	    MenuService::assign_positions_conditions($tpl, $this->get_block());
 
	    $lang = LangLoader::get('common', 'blog');

	    $user = AppContext::get_current_user();

	    $tpl->put_all(array(
	    	'MODULE_MINI_TITLE' => $lang['module_mini_title'],
	    	'MANAGE_A_BLOG_LINK' => BlogUrlBuilder::manage_blog($user->get_id())->absolute(),
	    	'MANAGE_A_BLOG' => $lang['manage_a_blog'],
	    	'CREATE_A_BLOG_LINK' => $lang['create_a_blog_link'],
	    	'CREATE_A_BLOG' => $lang['create_a_blog'],
	    	'BLOGS_LIST_LINK' => $lang['blogs_list_link'],
	    	'BLOGS_LIST' => $lang['blogs_list'],
	    ));
 
	    // Retourne l'affichage du menu
	    return $tpl->render();
    }

}