## 思路
这条利用链与thinkphp5.2.x中使用的版本后半部分是一样的，__toString()之前的利用链断了，因为windows类的删除，需要另辟蹊径
```
//依旧从__destruct入手，在\tp6x\vendor\topthink\think-orm\src\Model.php中
__destruct() --> save() -->  updateDate() -->  checkAllowFields() 
```
checkAllowFields()函数中存在字符串拼接方法，只要控制$this->suffix或者$this->table其中任意变量为Pivot类即可，类实例被当作字符串拼接，会调用其__toString()方法，回到了v5.2.x的利用链
![在这里插入图片描述](https://img-blog.csdnimg.cn/2019101716220741.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)
构造POC的过程顺便学习了一下PHP中private，protected变量的区别

## private与protected区别
private只能在父类内部使用，无法继承  
protected可以在父类和子类内部使用，可以继承  

protected成员变量可以被继承，private不行，但都是在内部使用，private在父类中，protected在父类子类中  
 
 ![在这里插入图片描述](https://img-blog.csdnimg.cn/20191017162909461.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)
 ![在这里插入图片描述](https://img-blog.csdnimg.cn/20191017162917263.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)
 
输出是一样的  

 ![在这里插入图片描述](https://img-blog.csdnimg.cn/20191017162923138.png)
 
**正是因为protected可以被继承，但继承后在不能被外部访问，只能在子类内部访问**
 
私有变量无法继承，通过继承父类初始化方法修改父类私有变量  

 ![在这里插入图片描述](https://img-blog.csdnimg.cn/20191017162937991.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)
 ![在这里插入图片描述](https://img-blog.csdnimg.cn/20191017162944411.png)
 
 
 
因为没有继承，所以赋值`$this->a`会创建变量，但不会影响父类中的变量，所以调用析构方法不会返回yes  
 
 ![在这里插入图片描述](https://img-blog.csdnimg.cn/20191017162952336.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)
 
![在这里插入图片描述](https://img-blog.csdnimg.cn/20191017162956756.png)

## POC
首先在\app\controller\Index.php中添加利用条件  

![在这里插入图片描述](https://img-blog.csdnimg.cn/20191017163107784.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3FxXzQxODA5ODk2,size_16,color_FFFFFF,t_70)

构造POC的时候注意在web根目录下引入第三方\Opis\Closure函数库vendor，才能序列化闭包对象，否则会报错  

```
//导入
require __DIR__ . '/vendor/autoload.php';
```
https://github.com/Dido1960/thinkphp/tree/master/v6.0.x/poc

## reference
https://www.anquanke.com/post/id/187393
https://xz.aliyun.com/t/6479
