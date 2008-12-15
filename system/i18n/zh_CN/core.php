<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = array
(
	'there_can_be_only_one' => '每个请求页面只允许一个Kohana实例.',
	'uncaught_exception'    => '未捕获%s异常: %s 于文件 %s 在行 %s',
	'invalid_method'        => '无效方法 <tt>%s</tt> 调用于 <tt>%s</tt>.',
	'log_dir_unwritable'    => '你的 log.directory 指向不可写目录.',
	'resource_not_found'    => '请求的 %s, <tt>%s</tt>, 不存在.',
	'no_default_route'      => '请在 <tt>config/routes.php</tt> 设置默认的路由参数值.',
	'no_controller'         => 'Kohana没有找到处理该请求的控制器: %s',
	'page_not_found'        => '您请求的页面 <tt>%s</tt>, 不存在.',
	'stats_footer'          => '页面加载 {execution_time} 秒, 使用内存 {memory_usage} . Generated by Kohana v{kohana_version}.',
	'error_message'         => '有错误发生，在行<strong> %s</strong> 的 <strong>%s</strong>.'
);