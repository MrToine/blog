<?php
/*##################################################
 *                           BlogListModuleMiniMenu.class.php
 *                            -------------------
 *   begin                : October 26, 2017
 *   copyright            : (C) 2017 Anthony VIOLET
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

class BlogListModuleMiniMenu extends ModuleMiniMenu {

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
    	$tpl = new FileTemplate('blog/menus/blogList_mini.tpl');
 
    	// Permet d'assigner les variables tpl au template pour pouvoir ensuite donner un affichage différent selon la colonne où est situé le menu
	    MenuService::assign_positions_conditions($tpl, $this->get_block());
 
	    $lang = LangLoader::get('common', 'blog');

	    $views_blogs = PersistenceContext::get_querier()->select('SELECT * FROM '.PREFIX.'blog ORDER BY views DESC');

		while ($row = $views_blogs->fetch())
		{

			$blog = new Blog();
			$blog->set_properties($row);

			$tpl->assign_block_vars('views_blogs', $blog->get_array_tpl_vars(), array(
				'TXT_VIEWS' => $lang['module.views'],
				'LINK' => BlogUrlBuilder::blog_user($blog->get_id())->absolute()
			));

		}

		$lasts_blogs = PersistenceContext::get_querier()->select('SELECT * FROM '.PREFIX.'blog JOIN '.DB_TABLE_MEMBER.' ON '.DB_TABLE_MEMBER.'.user_id = '.PREFIX.'blog.author_id ORDER BY id DESC');

		while ($row = $lasts_blogs->fetch())
		{

			$blog = new Blog();
			$blog->set_properties($row);

			$tpl->assign_block_vars('lasts_blogs', $blog->get_array_tpl_vars(), array(
				'TXT_LAST' => $lang['module.views'],
				'LINK' => BlogUrlBuilder::blog_user($blog->get_id())->absolute(),
				'LINK_USER_PROFILE'=> UserUrlBuilder::profile($row['user_id'])->absolute(),
				'USERNAME' => $row['display_name']
			));

		}

		$tpl->put_all(array(
			'BEST_BLOGS' => $lang['mini.best.blogs'],
			'TITLE_VIEWS' => $lang['mini.list.views'],
			'TITLE_LAST' => $lang['mini.list.last'],
			'NB_BLOGS' => BlogService::count_blogs()
		));
 
	    // Retourne l'affichage du menu
	    return $tpl->render();
    }

}