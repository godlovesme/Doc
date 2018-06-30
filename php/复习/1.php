<?php
/**
* PHP 5.6 以下
*/

PHP（全称：PHP：Hypertext Preprocessor，即"PHP：超文本预处理器"）是一种通用开源脚本语言。

PHP 支持 8 种原始数据类型。 

四种标量类型： 
1. boolean （布尔型）  
2. integer （整型）  
3. float （浮点型，也称作 double )  
4. string （字符串）  

两种复合类型： 
1. array （数组）  
2. object （对象）  

最后是两种特殊类型： 
1. resource （资源）  
2. NULL （无类型）  


boolean 转换

var_dump ((bool)  "" );       	// bool(false)
var_dump ((bool) array());    	// bool(false)

var_dump ((bool)  1 );          // bool(true)
var_dump ((bool) - 2 );         // bool(true)
var_dump ((bool)  "foo" );      // bool(true)
var_dump ((bool)  2.3e5 );      // bool(true)
var_dump ((bool) array( 12 ));  // bool(true)
var_dump ((bool)  "false" );    // bool(true)


integer

整型数的字长和平台有关，尽管通常最大值是大约二十亿（32 位有符号）。
64 位平台下的最大值通常是大约 9E18。
PHP 不支持无符号整数。
Integer  值的字长可以用常量 PHP_INT_SIZE 来表示，
自 PHP 4.4.0 和 PHP 5.0.5后，最大值可以用常量 PHP_INT_MAX  来表示。 

float 

浮点数的字长和平台相关，尽管通常最大值是 1.8e308 并具有 14 位十进制数字的精度（64 位 IEEE 格式）。 

String

一个字符串 string  就是由一系列的字符组成，其中每个字符等同于一个字节。
这意味着 PHP 只能支持 256 的字符集，因此不支持 Unicode 。

双引号 解析 转义

\n  换行（ASCII 字符集中的 LF 或 0x0A (10)） 
\r  回车（ASCII 字符集中的 CR 或 0x0D (13)） 
\t  水平制表符（ASCII 字符集中的 HT 或 0x09 (9)） 
\v  垂直制表符（ASCII 字符集中的 VT 或 0x0B (11)）（自 PHP 5.2.5 起） 
\e  Escape（ASCII 字符集中的 ESC 或 0x1B (27)）（自 PHP 5.4.0 起） 
\f  换页（ASCII 字符集中的 FF 或 0x0C (12)）（自 PHP 5.2.5 起） 
\\  反斜线 
\$  美元标记 
\"  双引号 
\[0-7]{1,3}  符合该正则表达式序列的是一个以八进制方式来表达的字符  
\x[0-9A-Fa-f]{1,2}  符合该正则表达式序列的是一个以十六进制方式来表达的字符 " 


Heredoc 结构 

echo <<<EOT
123456789
abcdefghi
$abc
EOT;


Nowdoc 结构 不解析

echo <<<EOT
123456789
abcdefghi
$abc
EOT;


// 有效
echo  "This square is  {$square->width} 00 centimeters broad." ; 

// 有效
echo  "This works:  {$arr['key']} " ;


Array


array(  key =>  value
     , ...
     )
// 键（key）可是是一个整数  integer  或字符串  string 
// 值（value）可以是任意类型的值

// 自 PHP 5.4 起
$array  = [
     "foo"  =>  "bar" ,
     "bar"  =>  "foo" ,
];


此外 key 会有如下的强制转换： 
1.  包含有合法整型值的字符串会被转换为整型。例如键名 "8" 实际会被储存为 8。但是 "08" 则不会强制转换，因为其不是一个合法的十进制数值。  
2.  浮点数也会被转换为整型，意味着其小数部分会被舍去。例如键名 8.7 实际会被储存为 8。  
3.  布尔值也会被转换成整型。即键名 true 实际会被储存为 1 而键名 false 会被储存为 0。  
4. Null  会被转换为空字符串，即键名 null 实际会被储存为 ""。  
5.  数组和对象不能被用为键名。坚持这么做会导致警告：Illegal offset type。 

object

转换为对象

如果将一个对象转换成对象，它将不会有任何变化。如果其它任何类型的值被转换成对象，
将会创建一个内置类 stdClass 的实例。如果该值为 NULL ，则新的实例为空。
数组转换成对象将使键名成为属性名并具有相对应的值。对于任何其它的值，名为 scalar 的成员变量将包含该值。 


$obj  = (object)  'ok' ;
echo  $obj -> scalar ;   // outputs 'ok'


NULL 

在下列情况下一个变量被认为是 NULL ： 

1. 被赋值为 NULL 。 


2. 尚未被赋值。 


3. 被 unset() 。 


--变量

PHP 中的变量用一个美元符号后面跟变量名来表示。变量名是区分大小写的。

有效的变量名由字母或者下划线开头，后面跟上任意数量的字母，数字，或者下划线。

变量默认总是传值赋值。那也就是说，当将一个表达式的值赋予一个变量时，整个原始表达式的值被赋值到目标变量。

使用引用赋值，简单地将一个 & 符号加到将要赋值的变量前（源变量）。


$a = 1;
$b = 2;

$b = &$a;     // 赋予引用 和 值

echo "<pre>";
var_dump($b);  //1
var_dump($a);  //1

unset($a);     只是删除引用
var_dump($b);  //1
var_dump($a);  //NULL 

变量范围

$a  =  1 ;
$b  =  2 ;

function  Sum ()
{
	global  $a ,  $b ;  //全局变量
	$b  =  $a  +  $b ;
}

function  test ()
{
    static  $a  =  0 ;  // 静态变量
    echo  $a ;
    $a ++;
}


--常量

常量和变量有如下不同： 
1.常量前面没有美元符号（$）；
2.常量只能用 define() 函数定义，而不能通过赋值语句；
3.常量可以不用理会变量的作用域而在任何地方定义和访问；
4.常量一旦定义就不能被重新定义或者取消定义；
5.常量的值只能是标量。 

定义常量 
define ( "CONSTANT" ,  "Hello world." );

// 以下代码在 PHP 5.3.0 后可以正常工作
const  CONSTANT  =  'Hello World' ;

魔术常量

__LINE__   	int(11)  文件中的当前行号。   
__FILE__  	string(12) "E:\php\1.php"  文件的完整路径和文件名。  
__DIR__ 	string(6) "E:\php"  文件所在的目录。如果用在被包括文件中，则返回被包括的文件所在的目录。它等价于 dirname(__FILE__)。
__FUNCTION__   	函数名称（PHP 4.3.0 新加）。自 PHP 5 起本常量返回该函数被定义时的名字（区分大小写）。
__CLASS__   	类的名称（PHP 4.3.0 新加）。自 PHP 5 起本常量返回该类被定义时的名字（区分大小写）。
__TRAIT__   	Trait 的名字（PHP 5.4.0 新加）。
__METHOD__   	类的方法名（PHP 5.0.0 新加）。返回该方法被定义时的名字（区分大小写）。  
__NAMESPACE__   当前命名空间的名称（区分大小写）。此常量是在编译时定义的（PHP 5.3.0 新增）。  


include 语句包含并运行指定文件。 

被包含文件先按参数给出的路径寻找，如果没有给出目录（只有文件名）时则按照 include_path 指定的目录寻找。
如果在 include_path 下没找到该文件则 include 最后才在调用脚本文件所在的目录和当前工作目录下寻找。
如果最后仍未找到文件则 include 结构会发出一条警告；这一点和 require  不同，后者会发出一个致命错误。 

当一个文件被包含时，其中所包含的代码继承了 include 所在行的变量范围。
从该处开始，调用文件在该行处可用的任何变量在被调用的文件中也都可用。
不过所有在包含文件中定义的函数和类都具有全局作用域。 



--类

class  SimpleClass
{
	// property declaration
	public  $var  =  'a default value' ;

	// method declaration
	public function  displayVar () {
		echo  $this -> var ;
	}
}

当一个方法在类定义内部被调用时，有一个可用的伪变量 $this 。 $this  是一个到主叫对象的引用

要创建一个类的实例，必须使用 new 关键字。

$instance  = new  SimpleClass ();

// 也可以这样做：
$className  =  'Foo' ;
$instance  = new  $className ();  // Foo()

在类定义内部，可以用 new self 和 new parent 创建新对象。 


一个类可以在声明中用 extends 关键字继承另一个类的方法和属性。PHP不支持多重继承，一个类只能继承一个基类。

被继承的方法和属性可以通过用同样的名字重新声明被覆盖。
但是如果父类定义方法时使用了 final，则该方法不可被覆盖。
可以通过 parent:: 来访问被覆盖的方法或属性。 


class  ExtendClass  extends  SimpleClass
{
	// Redefine the parent method
	function  displayVar ()
	{
	    echo  "Extending class\n" ;
	    parent :: displayVar ();
	}
}

$extended  = new  ExtendClass ();
$extended -> displayVar ();

属性 修饰关键字

public 公有
protected 受保护
private 私有

在类的成员方法里面，可以用 ->（对象运算符）： $this->property （其中 property 是该属性名）这种方式来访问非静态属性。
静态属性则是用 ::（双冒号）： self::$property  来访问。

类常量

class  MyClass
{
	const  constant  =  'constant value' ;

	function  showConstant () {
	    echo   self :: constant  .  "\n" ;
	}
}


自动加载类

function  __autoload ( $class_name ) {
    require_once  $class_name  .  '.php' ;
}

$obj   = new  MyClass1 ();
$obj2  = new  MyClass2 ();

构造函数和析构函数

class  BaseClass  {
	//每次创建新对象时先调用此方法
	function  __construct () {
		print  "In BaseClass constructor\n" ;
	}
	//某个对象的所有引用都被删除或者当对象被显式销毁时执行。 
	function  __destruct () {
		print  "Destroying "  .  $this -> name  .  "\n" ;
	}
}


抽象类

PHP 5 支持抽象类和抽象方法。定义为抽象的类不能被实例化。
任何一个类，如果它里面至少有一个方法是被声明为抽象的，那么这个类就必须被声明为抽象的。
被定义为抽象的方法只是声明了其调用方式（参数），不能定义其具体的功能实现。 

abstract class  AbstractClass
{
	// 强制要求子类定义这些方法
	abstract protected function  getValue ();
	abstract protected function  prefixValue ( $prefix );

	// 普通方法（非抽象方法）
	public function  printOut () {
		print  $this -> getValue () .  "\n" ;
	}
}


class  ConcreteClass1  extends  AbstractClass
{
	protected function  getValue () {
	    return  "ConcreteClass1" ;
	}

	public function  prefixValue ( $prefix ) {
	    return  " { $prefix } ConcreteClass1" ;
	}
}


对象接口

使用接口（interface），可以指定某个类必须实现哪些方法，但不需要定义这些方法的具体内容。

interface  iTemplate
{
	public function  setVariable ( $name ,  $var );
	public function  getHtml ( $template );
}


// 实现接口
// 下面的写法是正确的
class  Template  implements  iTemplate
{
	private  $vars  = array();

	public function  setVariable ( $name ,  $var )
	{
	     $this ->vars[$name] =  $var;
	}

	public function  getHtml ( $template )
	{
	    foreach( $this->vars  as  $name  =>  $value ) {
	         $template  =  str_replace ( '{'  .  $name  .  '}' ,  $value ,  $template );
	    }

	    return  $template ;
	}
}



Traits

自 PHP 5.4.0 起，PHP 实现了代码复用的一个方法，称为 traits。 

从基类继承的成员被 trait 插入的成员所覆盖。
优先顺序是来自当前类的成员覆盖了 trait 的方法，而 trait 则覆盖了被继承的方法。

对于父类成员和方法：trait 会覆盖
对于子类成员和方法会覆盖trait

class  Base  {
    public function  sayHello () {
        echo  'Hello ' ;
    }
}

trait  SayWorld  {
    public function  sayHello () {
        parent :: sayHello ();
        echo  'World!' ;
    }
}

class  MyHelloWorld  extends  Base  {
    use  SayWorld ;
}

$o  = new  MyHelloWorld ();
$o -> sayHello ();


多个

trait  Hello  {
    public function  sayHello () {
        echo  'Hello ' ;
    }
}

trait  World  {
    public function  sayWorld () {
        echo  'World' ;
    }
}

class  MyHelloWorld  {
    use  Hello ,  World ;
    public function  sayExclamationMark () {
        echo  '!' ;
    }
}

重载

PHP所提供的"重载"（overloading）是指动态地"创建"类属性和方法。
我们是通过魔术方法（magic methods）来实现的。 


在给不可访问属性赋值时，__set() 会被调用。 

读取不可访问属性的值时，__get() 会被调用。 

当对不可访问属性调用 isset()  或 empty()  时，__isset() 会被调用。 

当对不可访问属性调用 unset()  时，__unset() 会被调用。 

在对象中调用一个不可访问方法时，__call() 会被调用。 

用静态方式中调用一个不可访问方法时，__callStatic() 会被调用。 


魔术方法

__toString() 	方法用于一个类被当成字符串时应怎样回应。例如 echo $obj; 
__invoke()   	当尝试以调用函数的方式调用一个对象时，__invoke() 方法会被自动调用。 
__set_state()  	起当调用 var_export()  导出类时，此静态 方法会被调用。 

__construct()	构造函数
__destruct()	析构函数

__call() 		在对象中调用一个不可访问方法时，__call() 会被调用。 
__callStatic()	用静态方式中调用一个不可访问方法时，__callStatic() 会被调用。 

__set()			在给不可访问属性赋值时，__set() 会被调用。 
__get()			读取不可访问属性的值时，__get() 会被调用。 
__isset()		当对不可访问属性调用 isset()  或 empty()  时，__isset() 会被调用。 
__unset() 		当对不可访问属性调用 unset()  时，__unset() 会被调用。 
__clone()		复制调用


Final 关键字

如果父类中的方法被声明为 final，则子类无法覆盖该方法。如果一个类被声明为 final，则不能被继承。 


--命名空间

解决

1.  用户编写的代码与PHP内部的类/函数/常量或第三方类/函数/常量之间的名字冲突。  
2.  为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性。 


命名空间必须是程序脚本的第一条语句


namespace  MyProject ;

const  CONNECT_OK  =  1 ;
class  Connection  {  /* ... */  }
function  connect () {  /* ... */   }


namespace  AnotherProject ;

const  CONNECT_OK  =  1 ;
class  Connection  {  /* ... */  }
function  connect () {  /* ... */   }


namespace  MyProject \ Sub \ Level ;

const  CONNECT_OK  =  1 ;
class  Connection  {  /* ... */  }
function  connect () {  /* ... */   }


类名可以通过三种方式引用： 

1.  非限定名称，或不包含前缀的类名称，例如 $a=new foo(); 或 foo::staticmethod();。
如果当前命名空间是 currentnamespace，foo 将被解析为 currentnamespace\foo。
如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，则 foo 会被解析为foo。   
警告：如果命名空间中的函数或常量未定义，则该非限定的函数名称或常量名称会被解析为全局函数名称或常量名称。
详情参见 使用命名空间：后备全局函数名称/常量名称。

2.  限定名称,或包含前缀的名称，例如 $a = new subnamespace\foo(); 或 subnamespace\foo::staticmethod();。
如果当前的命名空间是 currentnamespace，则 foo 会被解析为 currentnamespace\subnamespace\foo。
如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析为subnamespace\foo。  

3.  完全限定名称，或包含了全局前缀操作符的名称，例如， $a = new \currentnamespace\foo(); 或 \currentnamespace\foo::staticmethod();
在这种情况下，foo 总是被解析为代码中的文字名(literal name)currentnamespace\foo。 

导入

use  My \ Full \ Classname  as  Another ;

// 下面的例子与 use My\Full\NSname as NSname 相同
use  My \ Full \ NSname ;

// 导入一个全局类
use  ArrayObject ;

// importing a function (PHP 5.6+)
use function  My \ Full \ functionName ;

// aliasing a function (PHP 5.6+)
use function  My \ Full \ functionName  as  func ;

// importing a constant (PHP 5.6+)
use const  My \ Full \ CONSTANT ;

























