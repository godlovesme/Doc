## thinkphp5 教程 -- 数据库-Model


### 目录

	|--apps
		|--index
			|--controller
				|--Article.php
			|--model
				|--Article.php
				|--User.php
				|--UserConfig.php
			|--validate
				|--Article.php


1、 模型

model/Article.php -- 文件

	namespace app\index\model;

	use think\Model;

	class Article extends Model
	{

		// 直接使用配置参数名
		protected $connection = 'db_config1';

		// 设置当前模型对应的完整数据表名称
		protected $table = 'article';

		//自动完成[新增和修改时都会执行]
		protected $auto = ['update_time'];
		//新增时自动验证
		protected $insert = ['add_time'];  
		// protected $insert = ['status'=>1];  
		//修改时自动验证
		protected $update = [];  


		protected function setUpdateTimeAttr()
		{
		    return date('Y-m-d H:i:s');
		}
		protected function setAddTimeAttr()
		{
		    return date('Y-m-d H:i:s');
		}

		//自定义初始化
		protected function initialize()
		{
		    //需要调用`Model`的`initialize`方法
		    parent::initialize();
		    //TODO:自定义的初始化
		    // Article::get(1)  会执行两遍
		    dump('initialize');
		}

		//自定义初始化
		protected static function init()
		{
		    //TODO:自定义的初始化
		    dump("init");

		    /*事件*/
			// beforeInsert    新增前
			// afterInsert     新增后
			// beforeUpdate    更新前
			// afterUpdate     更新后
			// beforeWrite     写入前
			// afterWrite  	   写入后
			// beforeDelete    删除前
			// afterDelete     删除后
			// 事件方法如果返回false，则不会继续执行。
		    /*新增前*/
		    self::event('before_insert', function ($data) {
		        if ($data->status != 1) {
		            return false;
		        }
		    });

		}

		/*关联*/
		// belongsTo('关联模型名','当前模型的外键','关联表主键名',['模型别名定义'],'join类型');\
		// hasOne('关联模型名','关联表的外键','主键名',['模型别名定义'],'join类型');

		public function user()
		{
		    return $this->belongsTo('User',"user_id");
		}



	}


model/User.php -- 文件

	namespace app\index\model;

	use think\Model;

	class User extends Model
	{
	    protected $table = 'user';
	    // 直接使用配置参数名
	    protected $connection = 'db_config1';

	    /*关联*/
	    // belongsTo('关联模型名','当前模型的外键','关联表主键名',['模型别名定义'],'join类型');\
	    // hasOne('关联模型名','关联表的外键','主键名',['模型别名定义'],'join类型');
	    // hasMany('关联模型名','外键名','主键名',['模型别名定义']);
	    // 方法名不能用 下划线
	    public function userConfig()
	    {
	        return $this->hasOne('UserConfig',"user_id");
	    }

	    public function article()
	    {
	        return $this->hasMany('Article',"user_id");
	    }


	}

model/UserConfig.php -- 文件

	namespace app\index\model;

	use think\Model;

	class UserConfig extends Model
	{
	    protected $table = 'user_config';
	    // 直接使用配置参数名
		protected $connection = 'db_config1';

	    public function article()
	    {
	        return $this->hasOne('Article',"id");
	    }

	}

validate/Article.php -- 文件

	namespace app\index\validate;
	use think\Validate;

	class Article extends Validate
	{
	    protected $rule = [
	        'title'  =>  'require|max:25',
	        'status'   => 'number|between:0,1',
	    ];
	    
	    protected $message = [
	        'title.require'  =>  '标题必须',
	        'title.max' =>  '标题最多25个字',
	        'status.number' =>  '状态为数字',
	        'status.between' =>  '状态范围为0-1',
	    ];
	    
	    protected $scene = [
	        'add'   =>  ['title','status'],
	        'edit'  =>  ['title'],
	    ];    
	}


2、 新增

	/*新增单个*/
	$article = new Articles;
	$article->title = 'thinkphp';
	$article->status = 2;
	$article->save();
	/*获取新增ID*/
	// dump($article->id);

	// $article = new Articles;
	$article->data([
		'title'  =>  'thinkphp',
		'content' =>  'thinkphp@qq.com'
	]);
	// 如果不new 需要加入 isUpdate(false)
	$article->isUpdate(false)->save();
	dump($article->id);

	$article = new Articles([
		'title'  =>  'thinkphp',
		'content' =>  'thinkphp@qq.com'
	]);
	//影响的字段
	$article->allowField(['title'])->save();
	dump($article->id);	

	/*新增多个*/
	$article = new Articles;
	$list = [
	    ['title'  =>  '1','content' =>  '2'],
	    ['title'  =>  '3','content' =>  '4'],
	];
	$arr = $article->saveAll($list);
	dump($arr);

3、 更新

	$user = Articles::get(1);
	$user->title = 'thinkphp';
	$user->save();

	$article = new Articles;
	$article->save(['title'=>111],['id'=>3]);
	// 过滤post数组中的非数据表字段数据
	// allowField(true)
	// post数组中只有name和email字段会写入
	// allowField(['name','email'])

	/*更新多个*/
	$article = new Articles;
	$list = [
	    ['id'=>1, 'title'=>'thinkphp'],
	    ['id'=>2, 'title'=>'onethink']
	];
	$article->isUpdate()->saveAll($list);

	/*闭包*/
	$article = new Articles;
	$article->save(['title' => 'thinkphp'],function($query){
		// 更新status值为1 并且id大于10的数据
		$query->where('status', 1)->where('id', '>', 10);
	});


4、 删除

	Articles::destroy(1);
	//支持批量删除多个数据
	Articles::destroy([1,2,3]);

	//条件删除
	//删除状态为0的数据
	Articles::destroy(['status' => 0]);
	Articles::destroy(function($query){
	    $query->where('id','>',10);
	});

5、 查询
	
	<!-- 使用静态方法 -->

	// 取出主键为1的数据
	$article = Articles::get(1);
	echo $article->title;

	// 使用数组查询
	$article = Articles::get(['title' => 'thinkphp']);

	// 使用闭包查询
	$article = Articles::get(function($query){
	    $query->where('title', 'thinkphp');
	});
	echo $article->title;




	// 或者使用数组
	$list = Articles::all([1,2,3]);
	foreach($list as $key=>$info){
	    echo $info->title;
	}

	// 使用数组查询
	$list = Articles::all(['status'=>1]);

	// 使用闭包查询
	$list = Articles::all(function($query){
	    $query->where('status', 1)->limit(3)->order('id', 'asc');
	});

	foreach($list as $key=>$info){
	    echo $info->title;
	}

	
	Articles::where('id','>',10)->select();
	// Articles::where('name','thinkphp')->find();


	// 获取某个用户的标题
	Articles::where('id',10)->value('title');
	// 获取某个列的所有值
	Articles::where('status',1)->column('title');
	// 以id为索引
	Articles::where('status',1)->column('title','id');
	Articles::where('status',1)->column('id,title'); // 同tp3的getField

	// 根据name字段查询用户
	// $article = Articles::getByName('thinkphp');

	// 根据email字段查询用户
	// $article = Articles::getByEmail('thinkphp@qq.com');


	<!-- 链式 -->
	$article = new Articles();
	// 查询单个数据
	$article->where('title', 'thinkphp')
	    ->find();

	$article = new Articles();
	// 查询数据集
	$article->where('title', 'thinkphp')
	->limit(10)
	->order('id', 'desc')
	->select();


	/*聚合*/
	Articles::count();
	Articles::where('status','>',0)->count();
	Articles::where('status',1)->avg('id');
	Articles::max('id');



	/*关联*/

	$article = Articles::find(10);

	echo $article->user->username;


	$user = User::get(1);
	$arr = $user->userConfig->type;
	dump($arr);

	$arr = $user->article;
	foreach ($arr as $key => $value) {
		dump($value->id);
	}


	$article = new Articles;
	$data = ['status'=>1, 'title'=>'111'];
	// 调用当前模型对应的article验证器类进行数据验证
	$result = $article->validate(true)->save($data);
	if(false === $result){
		// 验证失败 输出错误信息
		dump($article->getError());
	}
	

	// 使用 Loader 类实例化（单例）
	// $user = \think\Loader::model('app\index\model\Article');


	// 或者使用助手函数`model`
	// $user = model('Article');
	// $user->name= 'thinkphp';
	// $user->save();
	// exit;

6、 验证使用

	// 日期格式验证
	Validate::dateFormat('2016-03-09','Y-m-d'); // true
	// 验证是否有效的日期
	Validate::is('2016-06-03','date'); // true
	// 验证是否有效邮箱地址
	Validate::is('thinkphp@qq.com','email'); // true
	// 验证是否在某个范围
	Validate::in('a',['a','b','c']); // true
	// 验证是否大于某个值
	Validate::gt(10,8); // true
	// 正则验证
	Validate::regex(100,'\d+'); // true

7、 验证规则


验证某个字段必须，例如：

	'name'=>'require'

验证某个字段的值是否为数字（采用filter_var验证），例如：

    'num'=>'number'

验证某个字段的值是否为浮点数字（采用filter_var验证），例如：

    'num'=>'float'

验证某个字段的值是否为布尔值（采用filter_var验证），例如：

    'num'=>'boolean'

验证某个字段的值是否为email地址（采用filter_var验证），例如：

    'email'=>'email'

验证某个字段的值是否为数组，例如：

    'info'=>'array'

验证某个字段是否为为 yes, on, 或是 1。这在确认"服务条款"是否同意时很有用，例如：

    'accept'=>'accepted'

验证值是否为有效的日期，例如：

    'date'=>'date'

验证某个字段的值是否为字母，例如：

    'name'=>'alpha'


验证某个字段的值是否为字母和数字，例如：

    'name'=>'alphaNum'

验证某个字段的值是否为字母和数字，下划线_及破折号-，例如：

    'name'=>'alphaDash'

验证某个字段的值是否为有效的域名或者IP，例如：

    'host'=>'activeUrl'

验证某个字段的值是否为有效的URL地址（采用filter_var验证），例如：

    'url'=>'url'验证某个字段的值是否为有效的IP地址（采用filter_var验证），例如：

    'ip'=>'ip'

验证某个字段的值是否为有效的IP地址（采用filter_var验证），例如：

    'ip'=>'ip'

验证某个字段的值是否为指定格式的日期，例如：

    'create_time'=>'dateFormat:y-m-d'



验证某个字段的值是否在某个范围，例如：

    'num'=>'in:1,2,3'


验证某个字段的值不在某个范围，例如：

    'num'=>'notIn:1,2,3'


验证某个字段的值是否在某个区间，例如：

    'num'=>'between:1,10'

验证某个字段的值不在某个范围，例如：

    'num'=>'notBetween:1,10'

验证某个字段的值的长度是否在某个范围，例如：

    'name'=>'length:4,25'


或者指定长度

    'name'=>'length:4'

验证某个字段的值的最大长度，例如：

    'name'=>'max:25'

验证某个字段的值的最小长度，例如：

    'name'=>'min:5'

验证某个字段的值是否在某个日期之后，例如：

    'begin_time' => 'after:2016-3-18',


验证某个字段的值是否在某个日期之前，例如：

    'end_time'   => 'before:2016-10-01',


验证当前操作（注意不是某个值）是否在某个有效日期之内，例如：

    'expire_time'   => 'expire:2016-2-1,2016-10-01',

验证当前请求的IP是否在某个范围，例如：

    'name'   => 'allowIp:114.45.4.55',


验证当前请求的IP是否禁止访问，例如：

    'name'   => 'denyIp:114.45.4.55',



验证某个字段是否和另外一个字段的值一致，例如：

    'repassword'=>'require|confirm:password'


验证是否大于等于某个值，例如：

    'score'=>'egt:60'
    'num'=>'>=:100'


验证是否大于某个值，例如：

    'score'=>'gt:60'
    'num'=>'>:100'

验证是否小于等于某个值，例如：

    'score'=>'elt:100'
    'num'=>'<=:100'


验证是否小于某个值，例如：

    'score'=>'lt:100'
    'num'=>'<:100'

验证是否等于某个值，例如：

    'score'=>'eq:100'
    'num'=>'=:100'
    'num'=>'same:100'

支持使用filter_var进行验证，例如：

    'ip'=>'filter:validate_ip'


验证当前请求的字段值是否为唯一的，例如：

    // 表示验证name字段的值是否在user表（不包含前缀）中唯一
    'name'   => 'unique:user',
    // 验证其他字段
    'name'   => 'unique:user,account',
    // 排除某个主键值
    'name'   => 'unique:user,account,10',
    // 指定某个主键值排除
    'name'   => 'unique:user,account,10,user_id',