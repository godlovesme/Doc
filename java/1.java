/**	
* java 笔记 一
*/


八种基本类型 {

	六种数字类型（四个整数型，两个浮点型），

	一种字符类型，

	还有一种布尔型。 

}


byte：

    byte 数据类型是8位、有符号的，以二进制补码表示的整数；
    最小值是 -128（-2^7）；
    最大值是 127（2^7-1）；
    默认值是 0；
    byte 类型用在大型数组中节约空间，主要代替整数，因为 byte 变量占用的空间只有 int 类型的四分之一；
    例子：byte a = 100，byte b = -50。

short：

    short 数据类型是 16 位、有符号的以二进制补码表示的整数
    最小值是 -32768（-2^15）；
    最大值是 32767（2^15 - 1）；
    Short 数据类型也可以像 byte 那样节省空间。一个short变量是int型变量所占空间的二分之一；
    默认值是 0；
    例子：short s = 1000，short r = -20000。


int：

    int 数据类型是32位、有符号的以二进制补码表示的整数；
    最小值是 -2,147,483,648（-2^31）；
    最大值是 2,147,483,647（2^31 - 1）；
    一般地整型变量[默认]为 int 类型；
    默认值是 0 ；
    例子：int a = 100000, int b = -200000。


long：

    long 数据类型是 64 位、有符号的以二进制补码表示的整数；
    最小值是 -9,223,372,036,854,775,808（-2^63）；
    最大值是 9,223,372,036,854,775,807（2^63 -1）；
    这种类型主要使用在需要比较大整数的系统上；
    默认值是 0L；
    例子： long a = 100000L，Long b = -200000L。
    "L"理论上不分大小写，但是若写成"l"容易与数字"1"混淆，不容易分辩。所以最好大写。


float：

    float 数据类型是单精度、32位、符合IEEE 754标准的浮点数；
    float 在储存大型浮点数组的时候可节省内存空间；
    默认值是 0.0f；
    浮点数不能用来表示精确的值，如货币；
    例子：float f1 = 234.5f。


double：

    double 数据类型是双精度、64 位、符合IEEE 754标准的浮点数；
    浮点数的默认类型为double类型；
    double类型同样不能表示精确的值，如货币；
    默认值是 0.0d；
    例子：double d1 = 123.4。


boolean：

    boolean数据类型表示一位的信息；
    只有两个取值：true 和 false；
    这种类型只作为一种标志来记录 true/false 情况；
    默认值是 false；
    例子：boolean one = true。

char：

    char类型是一个单一的 16 位 Unicode 字符；
    最小值是 \u0000（即为0）；
    最大值是 \uffff（即为65,535）；
    char 数据类型可以储存任何字符；
    例子：char letter = 'A';


位数大小：类型.SIZE
最小值：类型.MIN_VALUE
最大值：类型.MAX_VALUE


--常量

final double PI = 3.1415927;


--类型自动转换


低  到  高 会自动转换

byte,short,char—> int —> long—> float —> double 


--强制转换

int i =128;   
byte b = (byte)i;

因为 byte 类型是 8 位，最大值为127，所以当 int 强制转换为 byte 类型时，值 128 时候就会导致溢出。

浮点数到整数的转换是通过舍弃小数得到，而不是四舍五入，例如：

(int)23.7 == 23;        
(int)-45.89f == -45



--变量类型


public class Variable{
    static int allClicks=0;    // 类变量
 
    String str="hello world";  // 实例变量
 
    public void method(){

        int i =0;  // 局部变量

    }

|--局部变量

在方法、构造方法、或者语句块被执行的时候创建，当它们执行完成后，变量将会被销毁；

|--实例变量

当一个对象被实例化之后，每个实例变量的值就跟着确定；
实例变量在对象创建的时候创建，在对象被销毁的时候销毁；


import java.io.*;
public class Employee{
   // 这个实例变量对子类可见
   public String name;
   // 私有变量，仅在该类可见
   private double salary;
   //在构造器中对name赋值
   public Employee (String empName){
      name = empName;
   }
   //设定salary的值
   public void setSalary(double empSal){
      salary = empSal;
   }  
   // 打印信息
   public void printEmp(){
      System.out.println("名字 : " + name );
      System.out.println("薪水 : " + salary);
   }
 
   public static void main(String[] args){
      Employee empOne = new Employee("RUNOOB");
      empOne.setSalary(1000);
      empOne.printEmp();
   }
}


|--类变量（静态变量）

无论一个类创建了多少个对象，类只拥有类变量的一份拷贝。

静态变量在程序开始时创建，在程序结束时销毁。

静态变量可以通过：ClassName.VariableName的方式访问。


import java.io.*;
 
public class Employee {
    //salary是静态的私有变量
    private static double salary;
    // DEPARTMENT是一个常量
    public static final String DEPARTMENT = "开发人员";
    public static void main(String[] args){
    salary = 10000;
        System.out.println(DEPARTMENT+"平均工资:"+salary);
    }
}


--访问控制修饰符

    "default" (即缺省，什么也不写）: 在同一包内可见，不使用任何修饰符。使用对象：类、接口、变量、方法。

    private : 在同一类内可见。使用对象：变量、方法。 注意：不能修饰类（外部类）

    public : 对所有类可见。使用对象：类、接口、变量、方法

    protected : 对同一包内的类和所有子类可见。使用对象：变量、方法。 注意：不能修饰类（外部类）。 

--非访问修饰符

static 

	静态变量：

	    static 关键字用来声明独立于对象的静态变量，无论一个类实例化多少对象，
	    它的静态变量只有一份拷贝。静态变量也被称为类变量。局部变量不能被声明为 static 变量。

	静态方法：

	    static 关键字用来声明独立于对象的静态方法。静态方法不能使用类的非静态变量。
	    静态方法从参数列表得到数据，然后计算这些数据。 

final 
	
	变量：

	final 变量能被显式地初始化并且只能初始化一次。被声明为 final 的对象的引用不能指向不同的对象。
	但是 final 对象里的数据可以被改变。也就是说 final 对象的引用不能改变，但是里面的值可以改变。

	final 修饰符通常和 static 修饰符一起使用来创建类常量。



	public class Test{
	  final int value = 10;
	  // 下面是声明常量的实例
	  public static final int BOXWIDTH = 6;
	  static final String TITLE = "Manager";
	}


	方法

	类中的 final 方法可以被子类继承，但是不能被子类修改。

	声明 final 方法的主要目的是防止该方法的内容被修改。

	如下所示，使用 final 修饰符声明方法。


	public class Test{
	    public final void changeName(){
	       // 方法体
	    }
	}

	类

	final 类不能被继承，没有类能够继承 final 类的任何特性。

abstract 

	抽象类：

	抽象类不能用来实例化对象，声明抽象类的唯一目的是为了将来对该类进行扩充。

	一个类不能同时被 abstract 和 final 修饰。如果一个类包含抽象方法，那么该类一定要声明为抽象类，否则将出现编译错误。

	抽象类可以包含抽象方法和非抽象方法。 


	abstract class Caravan{
	   private double price;
	   private String model;
	   private String year;
	   public abstract void goFast(); //抽象方法
	   public abstract void changeColor();
	}


	抽象方法

	抽象方法是一种没有任何实现的方法，该方法的的具体实现由子类提供。

	抽象方法不能被声明成 final 和 static。

	任何继承抽象类的子类必须实现父类的所有抽象方法，除非该子类也是抽象类。

	如果一个类包含若干个抽象方法，那么该类必须声明为抽象类。抽象类可以不包含抽象方法。

	抽象方法的声明以分号结尾，例如：public abstract sample();。 


	public abstract class SuperClass{
	    abstract void m(); //抽象方法
	}
	 
	class SubClass extends SuperClass{
	     //实现抽象方法
	      void m(){
	          .........
	      }
	}


synchronized
	
	关键字声明的方法同一时间只能被一个线程访问。synchronized 修饰符可以应用于四个访问修饰符。 


	public synchronized void showDetails(){
	.......
	}

transient

	序列化的对象包含被 transient 修饰的实例变量时，java 虚拟机(JVM)跳过该特定的变量。

	该修饰符包含在定义变量的语句中，用来预处理类和变量的数据类型。 

	public transient int limit = 55;   // 不会持久化
	public int b; // 持久化


volatile

	volatile 修饰的成员变量在每次被线程访问时，都强制从共享内存中重新读取该成员变量的值。
	而且，当成员变量发生变化时，会强制线程将变化值回写到共享内存。
	这样在任何时刻，两个不同的线程总是看到某个成员变量的同一个值。

	一个 volatile 对象引用可能是 null。  

	public class MyRunnable implements Runnable
	{
	    private volatile boolean active;
	    public void run()
	    {
	        active = true;
	        while (active) // 第一行
	        {
	            // 代码
	        }
	    }
	    public void stop()
	    {
	        active = false; // 第二行
	    }
	}

	通常情况下，在一个线程调用 run() 方法（在 Runnable 开启的线程），在另一个线程调用 stop() 方法。
	如果 第一行 中缓冲区的 active 值被使用，那么在 第二行 的 active 值为 false 时循环不会停止。

	但是以上代码中我们使用了 volatile 修饰 active，所以该循环会停止。


--循环结构


int x = 10;
while( x < 20 ) {
	System.out.print("value of x : " + x );
	x++;
	System.out.print("\n");
}

int x = 10;
do{
	System.out.print("value of x : " + x );
	x++;
	System.out.print("\n");
}while( x < 20 );


for(int x = 10; x < 20; x = x+1) {
	System.out.print("value of x : " + x );
	System.out.print("\n");
}

String[] names ={"James", "Larry", "Tom", "Lacy"};
for( String name : names ) {
	System.out.print( name );
	System.out.print(",");
}



--Number & Math

（Integer、Long、Byte、Double、Float、Short）都是抽象类 Number 的子类。 


System.out.println("90 度的正弦值：" + Math.sin(Math.PI/2));  
System.out.println("0度的余弦值：" + Math.cos(0));  
System.out.println("60度的正切值：" + Math.tan(Math.PI/3));  
System.out.println("1的反正切值： " + Math.atan(1));  
System.out.println("π/2的角度值：" + Math.toDegrees(Math.PI/2));  

Math 相关方法

1 	xxxValue()
将 Number 对象转换为xxx数据类型的值并返回。

2 	compareTo()
将number对象与参数比较。

3 	equals()
判断number对象是否与参数相等。

4 	valueOf()
返回一个 Number 对象指定的内置数据类型

5 	toString()
以字符串形式返回值。

6 	parseInt()
将字符串解析为int类型。

7 	abs()
返回参数的绝对值。

8 	ceil()
返回大于等于( >= )给定参数的的最小整数。

9 	floor()
返回小于等于（<=）给定参数的最大整数 。

10 	rint()
返回与参数最接近的整数。返回类型为double。

11 	round()
它表示四舍五入，算法为 Math.floor(x+0.5)，即将原来的数字加上 0.5 后再向下取整，
所以，Math.round(11.5) 的结果为12，Math.round(-11.5) 的结果为-11。

12 	min()
返回两个参数中的最小值。

13 	max()
返回两个参数中的最大值。

14 	exp()
返回自然数底数e的参数次方。

15 	log()
返回参数的自然数底数的对数值。

16 	pow()
返回第一个参数的第二个参数次方。

17 	sqrt()
求参数的算术平方根。

18 	sin()
求指定double类型参数的正弦值。

19 	cos()
求指定double类型参数的余弦值。

20 	tan()
求指定double类型参数的正切值。

21 	asin()
求指定double类型参数的反正弦值。

22 	acos()
求指定double类型参数的反余弦值。

23 	atan()
求指定double类型参数的反正切值。

24 	atan2()
将笛卡尔坐标转换为极坐标，并返回极坐标的角度值。

25 	toDegrees()
将参数转化为角度。

26 	toRadians()
将角度转换为弧度。

27 	random()
返回一个随机数。