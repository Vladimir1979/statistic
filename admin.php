<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * (c) Alexander Schilling
 * http://alexanderschilling.ru
 * License GNU GPL 2+
 */
 
echo '<h1>' . t('Статистика', __FILE__) . '</h1>';

// получаем доступ к CI
$CI = & get_instance();

// ключ для опций
$options_key = 'plugin_statistic';

// если был пост
if ( $post = mso_check_post(array('f_session_id', 'f_submit')) )
{
	// проверяем реферала
	mso_checkreferer();
	
	// создаём массив с опциями
	$options = array();
    $options['hide_users'] = isset($post['f_hide_users']) ? 1 : 0;
    $options['hide_comusers'] = isset($post['f_hide_comusers']) ? 1 : 0;
    $options['hide_active_comusers'] = isset($post['f_hide_active_comusers']) ? 1 : 0;
    $options['hide_no_active_comusers'] = isset($post['f_hide_no_active_comusers']) ? 1 : 0;
	
	// сохраняем опции
	mso_add_option($options_key, $options, 'plugins');
	echo '<div class="update">' . t('Обновлено!', 'plugins') . '</div>';
}

$options = mso_get_option($options_key, 'plugins', array());

// начало фоормы
$form = '';
$form .= '<form action="" method="post">' . mso_form_session('f_session_id');
    
// показвать юзеров?
if (!isset($options['hide_users']))  $options['hide_users'] = true;
$chckout = ''; 
if ( (bool)$options['hide_users'] )
{
	$chckout = 'checked="false"';
} 
$form .= '<p>' . t('Скрыть "администраторов"?', __FILE__)
	. ' <input name="f_hide_users" type="checkbox" ' . $chckout . '></p>';

// показывать комюзеров?
if (!isset($options['hide_comusers']))  $options['hide_comusers'] = false;
$chckout = ''; 
if ( (bool)$options['hide_comusers'] )
{
	$chckout = 'checked="false"';
} 
$form .= '<p>' . t('Скрыть "Комюзеров (пользователей)"?', __FILE__)
	. ' <input name="f_hide_comusers" type="checkbox" ' . $chckout . '></p>';

// показывать активных комюзеров?
if (!isset($options['hide_active_comusers']))  $options['hide_active_comusers'] = false;
$chckout = ''; 
if ( (bool)$options['hide_active_comusers'] )
{
	$chckout = 'checked="false"';
} 
$form .= '<p>' . t('Скрыть "Активных"?', __FILE__)
	. ' <input name="f_hide_active_comusers" type="checkbox" ' . $chckout . '></p>';

// показывать не активных комюзеров?
if (!isset($options['hide_no_active_comusers']))  $options['hide_no_active_comusers'] = false;
$chckout = ''; 
if ( (bool)$options['hide_no_active_comusers'] )
{
	$chckout = 'checked="false"';
} 
$form .= '<p>' . t('Скрыть "Заблудившихся"?', __FILE__)
	. ' <input name="f_hide_no_active_comusers" type="checkbox" ' . $chckout . '></p>';

// конец формы
$form .= '<input type="submit" name="f_submit" value="' . t('Сохранить', __FILE__) . '" style="margin: 25px 0 5px 0;">';
$form .= '</form>';
	
// выводим форму
echo $form;
	
#end of file
