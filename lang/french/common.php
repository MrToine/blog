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
	'add_page' => 'Ajouter',
	'create_blog' => 'Créer mon blog',

	//->Liens administation
	'admin.config' => 'Configuration des blogs',

	//->Configuration module
	'config.module.configuration' => 'Configuration du module',
	'config.module.manager' => 'Gérer les blogs',
	'config.form.intro' => 'Sur cette page vous avez la possibilité de configuré entièrement le module. La configuration est divisé en plusieurs partie.',
	'config.form.left_column' => 'Afficher la colonne de gauche',
	'config.form.right_column' => 'Afficher la colonne de droite',
	'config.form.top_menu' => 'Afficher le menu en haut de page',
	'config.form.nb_blogs_per_user' => 'Nombre de blog autorisé par membre',
	'config.form.bloc_or_list' => 'Afficher les blogs en bloc ? Activé = oui',
	'config.form.bloc' => 'En bloc',
	'config.form.list' => 'En liste',
	'config.form.blog_style' => 'Permettre aux blogs d\'avoir un style différent au site',
	'config.form.blog_menu' => 'Permettre aux blogs d\'avoir un menu propre à lui',
	'config.form.success' => 'Les informations ont bien été enregistrés, et ont été mis à jours',

	'donation' => 'Plus de 20 heures ont été nécessaire pour le développement de ce module. Si vous voulez soutenir le projet, et soutenir son créateur vous pouvez faire un don paypal via le bouton ci-dessous. Ce n\'est bien sûre pas obligatoire et même sans ce petit geste, je garanti des modules de qualité et un suivis personnel pour chaque utilisateurs du module. Mais un simple don permet d\'encourager et de remercier un créateur pour son travail. Anthony VIOLET',
	'mail.creator.module' => 'anthony.violet@outlook.be',

	// Liste des blogs
	'head_user' => 'Auteur du blog',
	'head_name' => 'Nom & descrption',
	'head_created' => 'Créer le',

	// Liste des articles
	'by' => 'Par ',
	'the' => ' le ',
	'read_more' => '[Lire la suite]',
	'link_blog_post' => BlogUrlBuilder::blog_post()->absolute(),

	// Module mini
	'module_mini_title' => 'Gestionnaire de blog',
	'manage_a_blog' => 'Gérer mon blog',
	'create_a_blog_link' => BlogUrlBuilder::create_blog()->absolute(),
	'create_a_blog' => 'Créer un blog',
	'blogs_list_link' => BlogUrlBuilder::home()->absolute(),
	'blogs_list' => 'Liste des blogs',

	// Manager du blog
	'manager.manager_head_message' => 'Vous êtes dans l\'administration de votre blog. Vous pouvez ici, gérer l\'ensemble des options. Créer, modifier, supprimer des articles. Gérer l\'apparence et le contenu de votre blog.',
	'manager.admin_blog' => 'Administration du blog',
	'manager.admin_blog_link' => '#',
	'manager.create_post' => 'Créer un billet',
	'manager.create_post_link' => '#',
	'manager.manage_posts' => 'Gérer les billets',
	'manager.manage_posts_link' => '#',
	'manager.delete_blog' => 'Supprimer mon blog',
	'manager.delete_blog_link' => '#',
	//-->Formulaire
	'manager.form.title' => 'Titre du billet',
	'manager.form.title_desc' => 'Indiquez le titre du billet (max 255 caractères)',
	'manager.form.slug' => 'Réecrire l\'url',
	'manager.form.slug_desc' => 'Contient uniquement des lettres minuscules, des chiffres et des traits d\'union',
	'manager.form.content' => 'Contenu du billet',
	'manager.form.publied' => 'Publié le billet directement ?',
	'manager.posts.title' => 'Titre du billet',
	'manager.posts.created' => 'Date de création',
	'manager.posts.state' => 'Etat de votre billet',
	'manager.posts.actions' => 'Actions possible',

	// Créer un blog
	'creator.blog_name' => 'Nom du blog',
	'creator.blog_name_desc' => 'Indiquez le nom de votre blog',
	'creator.no_connected' => 'Il faut créer un compte sur le site pour créer un blog',
	'creator.description' => 'Petit description de votre blog (moins de 1000 caractères)',

	//->POSTS
	'state.post.publied' => '<span style="color:green">Publié</span>',
	'state.post.nopublied' => '<span style="color:red">Non publié</span>',
);