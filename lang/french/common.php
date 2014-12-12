<?php
/*##################################################
 *                            common.php
 *                            -------------------
 *   begin                : October 24, 2014
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


 ####################################################
 #						French						#
 ####################################################

$lang = array(
	// Pages title
	'module_title' => 'Blogs',
	'add_page' => 'Add',

	// Liste des blogs
	'head_user' => 'Auteur du blog',
	'head_name' => 'Nom & descrption',
	'head_created' => 'Créer le',
	'link_blog_user' => BlogUrlBuilder::blog_user()->absolute(),

	// Liste des articles
	'by' => 'Par ',
	'the' => ' le ',
	'read_more' => '[Lire la suite]',
	'link_blog_post' => BlogUrlBuilder::blog_post()->absolute(),

	// Module mini
	'module_mini_title' => 'Gestionnaire de blog',
	'manage_a_blog' => 'Gérer un blog',
	'create_a_blog_link' => BlogUrlBuilder::create_blog()->absolute(),
	'create_a_blog' => 'Créer un blog',
	'blogs_list_link' => BlogUrlBuilder::home()->absolute(),
	'blogs_list' => 'Liste des blogs',

	// Manager du blog
	'manager_head_message' => 'Vous êtes dans l\'administration de votre blog. Vous pouvez ici, gérer l\'ensemble des options. Créer, modifier, supprimer des articles. Gérer l\'apparence et le contenu de votre blog.',
	'admin_blog' => 'Administration du blog',
	'create_post' => 'Créer un billet',
	'manage_posts' => 'Gérer les billets',
	'delete_blog' => 'Supprimer mon blog',

);