<?php
/**
 * session
 */

--简介

一个访问者访问你的 web 网站将被分配一个唯一的 id, 就是所谓的会话 id. 
这个 id 可以存储在用户端的一个 cookie 中，也可以通过 URL 进行传递. 


--常量

SID  ( string ) 包含着会话名以及会话 ID 的常量，格式为 "name=ID"，
或者如果会话 ID 已经在适当的会话 cookie 中设定时则为空字符串。
这和 session_id()  返回的是同一个 ID。  

PHP_SESSION_DISABLED  ( int ) 自 PHP 5.4.0 起。
如果会话已禁用则返回 session_status()  的值。  

PHP_SESSION_NONE  ( int ) 自 PHP 5.4.0 起。
在会话已启用但是没有会话的时候返回 session_status()  的值。 

PHP_SESSION_ACTIVE  ( int ) 自 PHP 5.4.0 起。
在一个会话已启用并存在时返回 session_status()  的值。 

--基本使用

可以通过调用函数 session_start()  来手动开始一个会话。 
如果配置项 session.auto_start 设置为1， 那么请求开始的时候，会话会自动开始。 

PHP 脚本执行完毕之后，会话会自动关闭。 同时，也可以通过调用函数 session_write_close()  来手动关闭会话。 



--传送会话ID


有两种方式用来传送会话 ID： 
1. Cookies  
2. URL 参数 


--安全


1. session.cookie_lifetime=0。 0 表示特殊含义，它告知浏览器不要持久化存储 cookie 数据。 
也即，关闭浏览器的时候，会话 ID cookie 会被立即删除。 
如果将此项设置为非 0 的值，可能会导致会话 ID 被其他用户使用。 
大部分应用应该把此项设置为“0”。 如
果应用中有自动登录的功能，请自行实现一种更加安全的方式，而不要使用会话 ID 来完成自动登录。  

2. session.use_cookies=On 并且 session.use_only_cookies=On。 
虽然 HTTP cookie 存在一些问题， 但是它确实是实现会话 ID 管理的优选方案。 
尽可能的仅使用 cookie 来进行会话 ID 管理， 而且大部分应用也确实是只使用 cookie 来记录会话 ID 的。  

3. session.use_strict_mode=On。 此设置防止会话模块使用未初始化的会话 ID。 
也就是说， 会话模块仅接受由它自己创建的有效的会话 ID， 而拒绝由用户自己提供的会话 ID。
使用 JavaScript 对 cookie 进行注入 就可以实现对会话 ID 的注入， 甚至可以在 URL 的查询字符串中或者表单参数中实现会话 ID 的注入。 
大部分应用没理由也不应该接受由用户提供的未经初始化的会话 ID。  

4. session.cookie_httponly=On。 禁止 JavaScript 访问会话 cookie。 
此设置项可以保护 cookie 不被 JavaScript 窃取。 
虽然可以使用会话 ID 来作为防范跨站请求伪造（CSRF）的关键数据， 但是不建议你这么做。 
例如，攻击者可以把 HTML 源代码保存下来并且发送给其他用户。 为了安全起见， 开发者不应该在 web 页面中显示会话 ID。
几乎所有的应用都应该对会话 ID cookie 设置 httponly 为 On。  

5. session.cookie_secure=On。 仅允许在 HTTPS 协议下访问会话 ID cookie。 
如果你的 web 站点仅支持 HTTPS，那么必须将此选项设置为 On。 
对于仅支持 HTTPS 的 web 站点建议考虑使用强制安全传输技术（HSTS）。  

6. session.gc_maxlifetime=[尽可能的小]。 GC 的运行时机并不是精准的，带有一定的或然性，
所以这个设置项并不能确保 旧的会话数据被删除。
某些会话存储处理模块不使用此设置项。 更多的信息请参考会话存储模块的完整文档。
虽然开发人员不能完全依赖这个设置，但是还是建议将其设置的尽可能的小。 
调整 session.gc_probability 和 session.gc_divisor 设置项 可以使得过期的会话数据在适当的周期内被删除。 
如果需要使用自动登录的功能，请使用其他更加安全的方式自行实现， 而不要通过使用长生命周期的会话 ID 来实现。  

7. session.use_trans_sid=Off。 如果确实需要， 你也可以使用透明的会话 ID 管理。 
禁用透明会话 ID 管理可以提高安全性， 规避会话 ID 注入和泄露的风险。  

8. session.referer_check=[你的源 URL] 当启用 session.use_trans_sid 设置项时， 
建议尽可能的联合使用此设置项来降低会话 ID 注入的风险。 
假设你的站点是 http://example.com/， 请将此设置项置为 http://example.com/。 
需要注意的，如果使用 HTTPS ， 浏览器将不会发送 referrer 请求头， 因此，从安全角度考虑，此设置项并不总是可信赖的。 

9. session.cache_limiter=nocache。 确保对于已经认证的会话， 其 HTTP 内容不被缓存。 
你应仅允许缓存公开的内容， 否则将面临内容暴露的风险。 
如果 HTTP 内容中不包含安全信息或敏感数据，可以使用“private”。 
注意，“private”可能会导致客户端缓存私有数据。 仅在 HTTP 内容中不包含任何私有数据的时候，可以使用“public”。  

10. session.hash_function="sha256"。 高强度的散列函数可以产生高强度的会话 ID。 
虽然即使是使用 MD5 散列算法，要找到相同的散列值也是非常不易的， 
但是开发人员还是应该选择 SHA-2 或者更高的散列算法， 例如可以使用 sha384 或者 sha512。  


--函数

获取/设置当前会话 ID 
session_id  ([ string $id  ] )

启动新会话或者重用现有会话 
session_start  ([ array $options  = []  ] )

关闭写
session_write_close  ( void )

返回当前session状态   (PHP >=5.4.0)
session_status( void )

	1. PHP_SESSION_DISABLED  if sessions are disabled. 
	2. PHP_SESSION_NONE  if sessions are enabled, but none exists. 
	3. PHP_SESSION_ACTIVE  if sessions are enabled, and one exists. 


读取/设置当前会话的保存路径 
session_save_path  ([ string $path  ] )

销毁一个会话中的全部数据 
session_destroy  ( void )




























