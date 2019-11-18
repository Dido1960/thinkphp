## 思路
```
// 路径
\thinkphp\library\think\process\pipes\Windows.php

// 析构方法入手
__destruct() --> removeFiles() --> files_exists($filename)

// 可控参数
$this->filename
```

file_exists()函数将参数当作字符串处理，可以触发类的__toString()魔术方法
```
// 路径
\thinkphp\library\think\model\concern\Conversion.php 

// 寻找__toString()的调用链
__toString() --> toJson()--> toArray()

//寻找  $可控变量->方法(参数可控) 的点
$relation->visible($name);

其中
$name --> （$this->append as $key => $name）
$relation--> getAttr($key) --> getData($name) --> array_key_exists($name, $this->data) --> $this->data[$name]

// 可控参数 
$this->append 
$this->$data

// 注意，Conversionll为代码复用的trait，需要寻找复用了他的类来进行利用
```

寻找没有visible方法的类，并且实现了__call()方法，这个方法的实现一般带着call_user_func_array

```
// 路径
\thinkphp\library\think\Request.php

__call()-->call_user_func_array($this->hook[$method], $args) 

//可控变量
$this->hook

// $args为数组，且第一个参数为类实例，难以利用
array_unshift($args, $this)
```

故寻找Requests.php中其他可以利用的函数，filter功能经常被利用，想办法利用call_user_func()方法

```
// 路径
\thinkphp\library\think\Request.php

//以前爆出过的利用点
filterValue(&$value, $key, $filters) --> call_user_func($filter, $value)

寻找执行流
isAjax() --> param($this->config->get('var_ajax')) --> input() --> array_walk_recursive($data, [$this, 'filterValue'], $filter)

其中
$this->config['var_ajax']可控，所以input()函数中的$name可控，刚好input()函数中$data参数也可控（为$_GET数组）
$data = $this->getData($data, $name) --> $data = $data[$val]
 
// 可控参数
$this->hook
$this->config['var_ajax']
$this -> $filter
$this -> $data（$_GET数组）
 
```

最终的反序列利用链
![在这里插入图片描述](https://img-blog.csdnimg.cn/2019092514002435.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)

在默认模块中构造利用点
![在这里插入图片描述](https://img-blog.csdnimg.cn/20190925143232558.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)

## POC
https://github.com/Dido1960/thinkphp/tree/master/v5.1.37/poc

## 参考文章
[挖掘暗藏ThinkPHP中的反序列利用链](https://blog.riskivy.com/%E6%8C%96%E6%8E%98%E6%9A%97%E8%97%8Fthinkphp%E4%B8%AD%E7%9A%84%E5%8F%8D%E5%BA%8F%E5%88%97%E5%88%A9%E7%94%A8%E9%93%BE/)
[Thinkphp 反序列化利用链深入分析](https://paper.seebug.org/1040/)
