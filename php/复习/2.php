<?php
/**
* php 函数
*/

String

当你要往数据库中输入数据时,需要对其进行转义。
addslashes()   		

反引用一个使用 addcslashes()  转义的字符串 
stripcslashes  ( string $str  )

返回相对应于 ascii 所指定的单个字符。 
chr(int $ascii)		

将字符串分割成小块 
chunk_split( string $body  [, int $chunklen  = 76  [, string $end  = "\r\n"  ]] )

使用 uuencode 编码一个字符串 
convert_uuencode( string $data  ) 

解码一个 uuencode 编码的字符串 
convert_uudecode( string $data  )

返回字符串所用字符的信息 
count_chars( string $string  [, int $mode  = 0  ] )  // mode = 1 只列出出现次数大于零的字节值。 

使用一个字符串分割另一个字符串 
explode  ( string $delimiter  , string $string  [, int $limit  ] )

将一个一维数组的值转化为字符串 
string implode  ( string $glue  , array $pieces  )

在字符串所有新行之前插入 HTML 换行标记 
nl2br  ( string $string  [, bool $is_xhtml  = true  ] )

返回字符的 ASCII 码值 
ord  ( string $string  )

子字符串替换 
str_replace( mixed  $search  , mixed  $replace  , mixed  $subject  [, int &$count  ] )

查找字符串的首次出现
strstr( string $haystack  , mixed  $needle  [, bool $before_needle  = false  ] ) 
//若为 TRUE ， strstr()  将返回 needle 在 haystack 中的位置之前的部分。

从字符串中去除 HTML 和 PHP 标记 
strip_tags  ( string $str  [, string $allowable_tags  ] )

查找字符串首次出现的位置（不区分大小写） 
stripos  ( string $haystack  , string $needle  [, int $offset  = 0  ] )

计算指定字符串在目标字符串中最后一次出现的位置（不区分大小写） 
strripos  ( string $haystack  , string $needle  [, int $offset  = 0  ] )

获取字符串长度 
strlen  ( string $string  )

将字符串转化为小写
strtolower  ( string $string  )

将字符串转化为大写 
strtoupper  ( string $string  )

返回字符串的子串 
substr  ( string $string  , int $start  [, int $length  ] )

去除字符串首尾处的空白字符（或者其他字符） 
trim  ( string $str  [, string $charlist  = " \t\n\r\0\x0B"  ] )

将字符串的首字母转换为大写 
ucfirst  ( string $str  )


Array


返回字符串键名全为小写或大写的数组 
array_change_key_case  ( array $input  [, int $case  = CASE_LOWER  ] ) // 返回字符串键名全为小写或大写的数组 

将一个数组分割成多个 
array_chunk  ( array $input  , int $size  [, bool $preserve_keys  = false  ] )


返回二维数组中指定的一列   5 >= 5.5.0
array_column ( array $input  , mixed  $column_key  [, mixed  $index_key  ] )


创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值 
array_combine  ( array $keys  , array $values  )

统计数组中所有的值出现的次数 
array_count_values  ( array $input  )


使用键名比较计算数组的差集 
array_diff_key  ( array $array1  , array $array2  [, array $...  ] )


用回调函数过滤数组中的单元 
array_filter  ( array $input  [, callable  $callback  = ""  ] )

交换数组中的键和值 
array_flip  ( array $trans  )

检查给定的键名或索引是否存在于数组中 
array_key_exists  ( mixed  $key  , array $search  )

返回数组中部分的或所有的键名 
array_keys  ( array $array  [, mixed  $search_value  [, bool $strict  = false  ]] )

将回调函数作用到给定数组的单元上 
array_map  ( callable  $callback  , array $arr1  [, array $...  ] )

合并一个或多个数组 
array_merge  ( array $array1  [, array $...  ] ) 

将数组最后一个单元弹出（出栈） 
array_pop  ( array &$array  )

将一个或多个单元压入数组的末尾（入栈） 
array_push  ( array &$array  , mixed  $var  [, mixed  $...  ] )


从数组中随机取出一个或多个单元 
array_rand  ( array $input  [, int $num_req  = 1  ] )

用回调函数迭代地将数组简化为单一的值 
array_reduce  ( array $input  , callable  $function  [, mixed  $initial  = NULL    ] )

使用传递的数组替换第一个数组的元素   5 >= 5.3.0, PHP 7
array_replace  ( array $array1  , array $array2  [, array $...  ] )

在数组中搜索给定的值，如果成功则返回相应的键名 
array_search  ( mixed  $needle  , array $haystack  [, bool $strict  = false  ] )

将数组开头的单元移出数组 
array_shift  ( array &$array  )

在数组开头插入一个或多个单元 
array_unshift  ( array &$array  , mixed  $var  [, mixed  $...  ] )

从数组中取出一段 
array_slice  ( array $array  , int $offset  [, int $length  = NULL    [, bool $preserve_keys  = false  ]] )

计算数组中所有值的和 
array_sum  ( array $array  )

移除数组中重复的值 
array_unique  ( array $array  [, int $sort_flags  = SORT_STRING  ] )

返回数组中所有的值 
array_values  ( array $input  )


对数组排序 
sort  ( array &$array  [, int $sort_flags  = SORT_REGULAR  ] )

对数组进行排序并保持索引关系 
asort  ( array &$array  [, int $sort_flags  = SORT_REGULAR  ] )

对数组按照键名排序 
ksort  ( array &$array  [, int $sort_flags  = SORT_REGULAR  ] )

对数组逆向排序 
rsort  ( array &$array  [, int $sort_flags  = SORT_REGULAR  ] )

对数组进行逆向排序并保持索引关系 
arsort  ( array &$array  [, int $sort_flags  = SORT_REGULAR  ] )

对数组按照键名逆向排序 
krsort  ( array &$array  [, int $sort_flags  = SORT_REGULAR  ] )


计算数组中的单元数目或对象中的属性个数 
count  ( mixed  $var  [, int $mode  = COUNT_NORMAL  ] )

将数组的内部指针指向最后一个单元 
end  ( array &$array  )

从数组中将变量导入到当前的符号表 
extract  ( array &$var_array  [, int $extract_type  = EXTR_OVERWRITE  [, string $prefix  = NULL    ]] )

检查数组中是否存在某个值 
in_array  ( mixed  $needle  , array $haystack  [, bool $strict  = FALSE    ] )















