/**	
* java 笔记 二
*/

1）对于==，如果作用于基本数据类型的变量，则直接比较其存储的 “值”是否相等；

如果作用于引用类型的变量，则比较的是所指向的对象的地址

2）对于equals方法，注意：equals方法不能作用于基本数据类型的变量

如果没有对equals方法进行重写，则比较的是引用类型的变量所指向的对象的地址；

诸如String、Date等类对equals方法进行了重写的话，比较的是所指向的对象的内容。


String str1 = new String("hello");
String str2 = new String("hello");
         
System.out.println(str1==str2); //false  
System.out.println(str1.equals(str2)); //true



--Character 类

 	 对单个字符进行操作。

Character ch = new Character('a');

1 	isLetter()
是否是一个字母

2 	isDigit()
是否是一个数字字符

3 	isWhitespace()
是否是一个空格

4 	isUpperCase()
是否是大写字母

5 	isLowerCase()
是否是小写字母

6 	toUpperCase()
指定字母的大写形式

7 	toLowerCase()
指定字母的小写形式

8 	toString()
返回字符的字符串形式，字符串的长度仅为1


--String 类

构造方式有11种

String greeting = "教程";

char[] helloArray = { 'r', 'u', 'n', 'o', 'o', 'b'};
String helloString = new String(helloArray);  

字符串长度
greeting.length();

连接字符串

"我的名字是 ".concat("Runoob");

"Hello," + " runoob" + "!"

格式化字符串

String fs = String.format("浮点型变量的值为 " +
	"%f, 整型变量的值为 " +
	" %d, 字符串变量的值为 " +
	" %s", 1.1F,11, "12");

1 	char charAt(int index)
返回指定索引处的 char 值。

2 	int compareTo(Object o)
把这个字符串和另一个对象比较。

3 	int compareTo(String anotherString)
按字典顺序比较两个字符串。

4 	int compareToIgnoreCase(String str)
按字典顺序比较两个字符串，不考虑大小写。

5 	String concat(String str)
将指定字符串连接到此字符串的结尾。

6 	boolean contentEquals(StringBuffer sb)
当且仅当字符串与指定的StringBuffer有相同顺序的字符时候返回真。

7 	static String copyValueOf(char[] data)
返回指定数组中表示该字符序列的 String。

8 	static String copyValueOf(char[] data, int offset, int count)
返回指定数组中表示该字符序列的 String。

9 	boolean endsWith(String suffix)
测试此字符串是否以指定的后缀结束。

10 	boolean equals(Object anObject)
将此字符串与指定的对象比较。

11 	boolean equalsIgnoreCase(String anotherString)
将此 String 与另一个 String 比较，不考虑大小写。

12 	byte[] getBytes()
 使用平台的默认字符集将此 String 编码为 byte 序列，并将结果存储到一个新的 byte 数组中。

13 	byte[] getBytes(String charsetName)
使用指定的字符集将此 String 编码为 byte 序列，并将结果存储到一个新的 byte 数组中。

14 	void getChars(int srcBegin, int srcEnd, char[] dst, int dstBegin)
将字符从此字符串复制到目标字符数组。

15 	int hashCode()
返回此字符串的哈希码。

16 	int indexOf(int ch)
返回指定字符在此字符串中第一次出现处的索引。

17 	int indexOf(int ch, int fromIndex)
返回在此字符串中第一次出现指定字符处的索引，从指定的索引开始搜索。

18 	int indexOf(String str)
 返回指定子字符串在此字符串中第一次出现处的索引。

19 	int indexOf(String str, int fromIndex)
返回指定子字符串在此字符串中第一次出现处的索引，从指定的索引开始。

20 	String intern()
 返回字符串对象的规范化表示形式。

21 	int lastIndexOf(int ch)
 返回指定字符在此字符串中最后一次出现处的索引。

22 	int lastIndexOf(int ch, int fromIndex)
返回指定字符在此字符串中最后一次出现处的索引，从指定的索引处开始进行反向搜索。

23 	int lastIndexOf(String str)
返回指定子字符串在此字符串中最右边出现处的索引。

24 	int lastIndexOf(String str, int fromIndex)
 返回指定子字符串在此字符串中最后一次出现处的索引，从指定的索引开始反向搜索。

25 	int length()
返回此字符串的长度。

26 	boolean matches(String regex)
告知此字符串是否匹配给定的正则表达式。

27 	boolean regionMatches(boolean ignoreCase, int toffset, String other, int ooffset, int len)
测试两个字符串区域是否相等。

28 	boolean regionMatches(int toffset, String other, int ooffset, int len)
测试两个字符串区域是否相等。

29 	String replace(char oldChar, char newChar)
返回一个新的字符串，它是通过用 newChar 替换此字符串中出现的所有 oldChar 得到的。

30 	String replaceAll(String regex, String replacement)
使用给定的 replacement 替换此字符串所有匹配给定的正则表达式的子字符串。

31 	String replaceFirst(String regex, String replacement)
 使用给定的 replacement 替换此字符串匹配给定的正则表达式的第一个子字符串。

32 	String[] split(String regex)
根据给定正则表达式的匹配拆分此字符串。

33 	String[] split(String regex, int limit)
根据匹配给定的正则表达式来拆分此字符串。

34 	boolean startsWith(String prefix)
测试此字符串是否以指定的前缀开始。

35 	boolean startsWith(String prefix, int toffset)
测试此字符串从指定索引开始的子字符串是否以指定前缀开始。

36 	CharSequence subSequence(int beginIndex, int endIndex)
 返回一个新的字符序列，它是此序列的一个子序列。

37 	String substring(int beginIndex)
返回一个新的字符串，它是此字符串的一个子字符串。

38 	String substring(int beginIndex, int endIndex)
返回一个新字符串，它是此字符串的一个子字符串。

39 	char[] toCharArray()
将此字符串转换为一个新的字符数组。

40 	String toLowerCase()
使用默认语言环境的规则将此 String 中的所有字符都转换为小写。

41 	String toLowerCase(Locale locale)
 使用给定 Locale 的规则将此 String 中的所有字符都转换为小写。

42 	String toString()
 返回此对象本身（它已经是一个字符串！）。

43 	String toUpperCase()
使用默认语言环境的规则将此 String 中的所有字符都转换为大写。

44 	String toUpperCase(Locale locale)
使用给定 Locale 的规则将此 String 中的所有字符都转换为大写。

45 	String trim()
返回字符串的副本，忽略前导空白和尾部空白。

46 	static String valueOf(primitive data type x)
返回给定data type类型x参数的字符串表示形式。


--StringBuffer 和 StringBuilder 类

和 String 类不同的是，StringBuffer 和 StringBuilder 类的对象能够被多次的修改，并且不产生新的未使用对象。 

String 对象一旦创建之后该对象是不可更改的，但后两者的对象是变量，是可以更改的。

String：适用于少量的字符串操作的情况

StringBuilder：适用于单线程下在字符缓冲区进行大量操作的情况

StringBuffer：适用多线程下在字符缓冲区进行大量操作的情况


StringBuffer sBuffer = new StringBuffer("菜鸟教程官网：");
sBuffer.append("www");
sBuffer.append(".runoob");
sBuffer.append(".com");
System.out.println(sBuffer);  


1 	public StringBuffer append(String s)
将指定的字符串追加到此字符序列。

2 	public StringBuffer reverse()
 将此字符序列用其反转形式取代。

3 	public delete(int start, int end)
移除此序列的子字符串中的字符。

4 	public insert(int offset, int i)
将 int 参数的字符串表示形式插入此序列中。

5 	replace(int start, int end, String str)
使用给定 String 中的字符替换此序列的子字符串中的字符。


1 	int capacity()
返回当前容量。

2 	char charAt(int index)
返回此序列中指定索引处的 char 值。

3 	void ensureCapacity(int minimumCapacity)
确保容量至少等于指定的最小值。

4 	void getChars(int srcBegin, int srcEnd, char[] dst, int dstBegin)
将字符从此序列复制到目标字符数组 dst。

5 	int indexOf(String str)
返回第一次出现的指定子字符串在该字符串中的索引。

6 	int indexOf(String str, int fromIndex)
从指定的索引处开始，返回第一次出现的指定子字符串在该字符串中的索引。

7 	int lastIndexOf(String str)
返回最右边出现的指定子字符串在此字符串中的索引。

8 	int lastIndexOf(String str, int fromIndex)
返回 String 对象中子字符串最后出现的位置。

9 	int length()
 返回长度（字符数）。

10 	void setCharAt(int index, char ch)
将给定索引处的字符设置为 ch。

11 	void setLength(int newLength)
设置字符序列的长度。

12 	CharSequence subSequence(int start, int end)
返回一个新的字符序列，该字符序列是此序列的子序列。

13 	String substring(int start)
返回一个新的 String，它包含此字符序列当前所包含的字符子序列。

14 	String substring(int start, int end)
返回一个新的 String，它包含此序列当前所包含的字符子序列。

15 	String toString()
返回此序列中数据的字符串表示形式。

--数组

存储固定大小的同类型元素。

dataType[] arrayRefVar;   // 首选的方法
 
或
 
dataType arrayRefVar[];  // 效果相同，但不是首选方法

声明方式：

int a1[];     int[] a2;    double b[];     Person[] p1;     String s1[];

不能指定其长度
int a[5];　　//非法


声明格式二

int[][] arr = new int[3][];

arr[0] = new int[3];

arr[1] = new int[2];

arr[2] = new int[1];


声明格式三

显式初始化二维数组：int[][] arr = {{1,5,7},{4,8},{3,9,20,12}}

A.     以上数组定义了一个长度为3的数组，arr.length=3

B.     数组中第一维数组的长度:arr[0].length=3


Length的使用

数组的元素的个数称作数组的长度。

对于一维数组，“数组名.length”的值就是数组中元素的个数。

对于二维数组“数组名.length”的值是它含有的一维数组的个数。


// 数组大小
int size = 10;
// 定义数组
double[] myList = new double[size];
myList[0] = 5.6;
myList[1] = 4.5;
myList[2] = 3.3;
myList[3] = 13.2;
myList[4] = 4.0;
myList[5] = 34.33;
myList[6] = 34.0;
myList[7] = 45.45;
myList[8] = 99.993;
myList[9] = 11123;
// 计算所有元素的总和
double total = 0;
for (int i = 0; i < size; i++) {
	total += myList[i];
}
System.out.println("总和为： " + total);



double[] myList = {1.9, 2.9, 3.4, 3.5};

// 打印所有数组元素
for (double element: myList) {
	System.out.println(element);
}


二维

String str[][] = new String[3][4];

String s[][] = new String[5][];

for (int i = 0; i < s.length; i++) {
	System.out.println(s[i]);
	for (String[] strings : s) {
		System.out.println(strings);
	}
	
}

1 	public static int binarySearch(Object[] a, Object key)
用二分查找算法在给定数组中搜索给定值的对象(Byte,Int,double等)。
数组在调用前必须排序好的。如果查找值包含在数组中，则返回搜索键的索引；否则返回 (-(插入点) - 1)。

2 	public static boolean equals(long[] a, long[] a2)
如果两个指定的 long 型数组彼此相等，则返回 true。
如果两个数组包含相同数量的元素，并且两个数组中的所有相应元素对都是相等的，则认为这两个数组是相等的。
换句话说，如果两个数组以相同顺序包含相同的元素，则两个数组是相等的。
同样的方法适用于所有的其他基本数据类型（Byte，short，Int等）。

3 	public static void fill(int[] a, int val)
将指定的 int 值分配给指定 int 型数组指定范围中的每个元素。
同样的方法适用于所有的其他基本数据类型（Byte，short，Int等）。

4 	public static void sort(Object[] a)
对指定对象数组根据其元素的自然顺序进行升序排列。
同样的方法适用于所有的其他基本数据类型（Byte，short，Int等）。


--日期时间

































