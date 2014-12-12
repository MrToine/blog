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
 #						English						#
 ####################################################

$lang = array(
	// Pages title
	'module_title' => 'Partners',
	'add_page' => 'Add',

	// Manage
	'partners_management' => 'Managing partners',
	'partners_update_banner' => 'Update my banner',
	'partners_add' => 'Add a partner',
	'partner_head_manage' => 'Actions',
	'partner_manage' => PartnersUrlBuilder::delete()->absolute(),
	'update_banner_success' => 'Your banner has been update.',
	'update_banner_error' => 'An error occured, your banner has not been saved.',
	'my_banner' => '<div class="notice">If you encouter any problems to upload for your banner, you can change it manually by overwriting the banner.png file in folder <strong>partners</strong>. <span style="color:red">Warning !</span> do note change the name of banner.</div>My current banner :',

	// entry/output links
	'link_entry' => PartnersUrlBuilder::link_entry()->absolute(),
	'link_out' => PartnersUrlBuilder::link_out()->absolute(),

	// Informations on my banner
	'link_my_banner' => PartnersUrlBuilder::link_my_banner()->absolute(),
	
	// messages & link
	'home_message' => 'Here are the differents partners of website. If you want to become partner, click on "Become a Partner". Partners are classified by entries decreasing. The first 5 are displayed on menu',
	'add_link' => '<a href="'.PartnersUrlBuilder::add()->absolute().'" class="basic-button">Become a partner</a>',

	// table
	'partner_head_logo' => 'Banner',
	'partner_head_name' => 'Partner',
	'partner_head_entry' => 'Entries',
	'partner_head_out' => 'Outputs',

	//Module mini
	'link_list_partners' => 'See all partners',

	// Add partenaire
	'add_message' => 'You will apply for partnership with <a href="'.HOST.'">'.HOST.'</a> To complete the request, thank to fill in the form bellow',
	'add_success' => 'You have been added to list of our partners.',
	'add_notice' => 'To have your site in ranking, you need to add this code on your website. It allows the classification of carefully your website. <span style="color:red">Warning : </span>. If you change this code or you do not use, our script will not take into account the number of visitors you sent him',

	// Form
	'form_name' => 'Name of your website',
	'form_name_desc' => 'Enter name of your website',

	'form_link' =>'Link of your website' ,
	'form_link_desc' => 'Enter link of your website',

	'form_link_banner' => 'Link of your banner',
	'form_link_banner_desc' => 'Enter link of your banner',

	'form_description' => 'Make a description on your website',

	// Errors
	'partner_not_exists' => '<div class="error">This partner does not exist</div>',

);
