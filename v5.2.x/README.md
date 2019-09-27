## 思路
```
// 析构方法入手
__destruct() --> removeFiles() --> files_exists($filename)
 
// 可控参数
new windows()->filename
 
// 绝对路径
D:\phpstudy\PHPTutorial\WWW\v52\vendor\topthink\framework\src\think\process\pipes\Windows.php
 ```


file_exists()函数将参数当作字符串处理，可以触发类的__toString()魔术方法

```
// 寻找__toString()的调用链
__toString() --> toJson()--> toArray()
 
//寻找  $可控变量->方法(参数可控) 的点（失败）
$relation->visible($name);
 
// 注意，寻找存在__call()方法且未实现visible()函数的类无果，另辟蹊径，到这之前的利用链与v5.1.37相同
 
//绝对路径
D:\phpstudy\PHPTutorial\WWW\v52\vendor\topthink\framework\src\think\model\concern\Conversion.php
 
```

利用点：think/model/concern/Attribute.php中getValue可函数动态调用函数
```
toArray() --> getAttr($key) --> getValue($name, $value, $relation) --> $closure($value, $this->data)
$closure = $this->withAttr[$fieldName] 
$this->filename = getRealFieldName($name) ，$name为$this->data中的键值
 
//可控参数
$this->withAttr
$this->data
 
//绝对路径
D:\phpstudy\PHPTutorial\WWW\v52\vendor\topthink\framework\src\think\model\concern\Attribute.php
 
//注意，这里Attribute，Conversion为trait，需要寻找复用这两个trait的类，刚好\think\Model复用了，\think\Model为抽象类，不能直接实例化，寻找到子类think\model\Pivot
 
 ```
函数名可控的话，可以利用序列化的匿名函数的姿势进行利用
 ```
$func = function(){phpinfo();};
$closure = new \Opis\Closure\SerializableClosure($func);
$closure($value, $this->data);// 这里的参数可以不用管
 
//注意，这里需要引入\Opis\Closure这个第三方库，具体查看官方文档
https://docs.opis.io/closure/3.x/serialize.html
```

最终的反序列利用链
![在这里插入图片描述](https://img-blog.csdnimg.cn/2019092801111542.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)

在默认模块中构造利用点
![在这里插入图片描述](https://img-blog.csdnimg.cn/20190925143232558.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)
## POC
构造POC的时候注意在web根目录下引入第三方\Opis\Closure函数库vendor，才能序列化闭包对象，否则会报错

```
//导入
require __DIR__ . '/vendor/autoload.php';
```
https://github.com/Dido1960/thinkphp/tree/master/v5.2.x/poc
## 参考文章
[thinkphp v5.2.x 反序列化利用链挖掘](https://www.anquanke.com/post/id/187332)
