<?php
/* 
* @Author >
* @Date:   2016-03-02 11:31:48
*/

/**
 * 缓存 传第二个参数代表设置缓存
 * @author LDF
 * @date 2014-12-17 15:02:24
 * @param  string $name [缓存名称]
 * @param  array  $data [缓存数据]
 * @param  string $dir  [缓存目录]
 * @return array      
 * <code>
 * cache('area'); 读取地区缓存
 * cache('area',-1); 删除地区缓存
 * cache('area',$data,'./newCache/'); 将缓存内容村在newCache目录下
 */
function cache($name, $data = null) {
	$dir  = UPLOAD_PATHS.'/Cache/';
	$dir .= substr(strrchr($dir,'/'),-1) == '/' ? '' : '/';
	if(!$name) return false;
	is_dir($dir) || mkdir($dir, 0777, true);
	$dir .= $name.'.php';
	if($data === -1) die(@unlink($dir));
	return is_null($data)
		? unserialize(file_get_contents($dir))
		: file_put_contents($dir, serialize($data));
}


/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string) {
	$string = str_replace('%20','',$string);
	$string = str_replace('%27','',$string);
	$string = str_replace('%2527','',$string);
	$string = str_replace('*','',$string);
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace('"','',$string);
	$string = str_replace(';','',$string);
	$string = str_replace('<','&lt;',$string);
	$string = str_replace('>','&gt;',$string);
	$string = str_replace("{",'',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('\\','',$string);
	$arr    = array('select','update','delete','insert','SELECT','UPDATE','DELETE','INSERT');
	$string = str_replace($arr,'',$string);
	return $string;
}

/**
 * xss过滤函数
 *
 * @param $string
 * @return string
 */
function remove_xss($string) {
	$string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

	$parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

	$parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

	$parm = array_merge($parm1, $parm2);

	for ($i = 0; $i < sizeof($parm); $i++) {
		$pattern = '/';
		for ($j = 0; $j < strlen($parm[$i]); $j++) {
			if ($j > 0) {
				$pattern .= '(';
				$pattern .= '(&#[x|X]0([9][a][b]);?)?';
				$pattern .= '|(&#0([9][10][13]);?)?';
				$pattern .= ')?';
			}
			$pattern .= $parm[$i][$j];
		}
		$pattern .= '/i';
		$string = preg_replace($pattern, ' ', $string);
	}
	return $string;
}


/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @update 2016-03-02 10:10
 * @return String
 */
function encode($string = '', $skey = 'cxphp') {
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('', '', ''), join('', $strArr));
}
/**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @update 2016-03-02 10:10
 * @return String
 */
function decode($string = '', $skey = 'cxphp') {
    $strArr = str_split(str_replace(array('', '', ''), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
}

/**
 * 获取汉字的拼音
 * @param $_String
 * @param string $_Code
 * @return mixed
 */
function pin_yin($_String, $_Code = 'UTF8') {
    //fn:获取拼音
    //GBK页面可改为gb2312，其他随意填写为UTF8
    $_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha" .
        "|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|" .
        "cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er" .
        "|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui" .
        "|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang" .
        "|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang" .
        "|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue" .
        "|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne" .
        "|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen" .
        "|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang" .
        "|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|" .
        "she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|" .
        "tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu" .
        "|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you" .
        "|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|" .
        "zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";
    $_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990" .
        "|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725" .
        "|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263" .
        "|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003" .
        "|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697" .
        "|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211" .
        "|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922" .
        "|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468" .
        "|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664" .
        "|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407" .
        "|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959" .
        "|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652" .
        "|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369" .
        "|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128" .
        "|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914" .
        "|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645" .
        "|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149" .
        "|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087" .
        "|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658" .
        "|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340" .
        "|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888" .
        "|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585" .
        "|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847" .
        "|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055" .
        "|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780" .
        "|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274" .
        "|-10270|-10262|-10260|-10256|-10254";
    $_TDataKey   = explode('|', $_DataKey);
    $_TDataValue = explode('|', $_DataValue);
    $_Data       = array_combine($_TDataKey, $_TDataValue);
    arsort($_Data);
    reset($_Data);
    if ($_Code != 'gb2312') {
        $_String = _U2_Utf8_Gb($_String);
    }

    $_Res = '';
    for ($i = 0; $i < strlen($_String); $i++) {
        $_P = ord(substr($_String, $i, 1));
        if ($_P > 160) {
            $_Q = ord(substr($_String, ++$i, 1));
            $_P = $_P * 256 + $_Q - 65536;
        }
        $_Res .= _pin_yin($_P, $_Data);
    }
    return preg_replace("/[^a-z0-9]*/", '', $_Res);
}
function _pin_yin($_Num, $_Data) {
    //fn:获取拼音
    if ($_Num > 0 && $_Num < 160) {
        return chr($_Num);
    } elseif ($_Num < -20319 || $_Num > -10247) {
        return '';
    } else {
        foreach ($_Data as $k => $v) {
            if ($v <= $_Num) {
                break;
            }
        }
        return $k;
    }
}
function _U2_Utf8_Gb($_C) {
    //fn:字符转换
    $_String = '';
    if ($_C < 0x80) {
        $_String .= $_C;
    } elseif ($_C < 0x800) {
        $_String .= chr(0xC0 | $_C >> 6);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif ($_C < 0x10000) {
        $_String .= chr(0xE0 | $_C >> 12);
        $_String .= chr(0x80 | $_C >> 6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif ($_C < 0x200000) {
        $_String .= chr(0xF0 | $_C >> 18);
        $_String .= chr(0x80 | $_C >> 12 & 0x3F);
        $_String .= chr(0x80 | $_C >> 6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    }
    return iconv('UTF-8', 'GB2312', $_String);
}

function md5_zhuniu($str) {

    if ($str) {
        return md5($str . 'zhuniu');
    } else {
        return '';
    }
}

function time_to_min($time) {
    $str = "";
    //echo $time;
    $str = date('Y-m-d H:i', $time);
    return $str;
}

function time_to_date($time) {
    $str = "";
    //echo $time;
    $str = date('Y-m-d H:i:s', $time);
    return $str;
}

function time_to_dates($time) {
    $str = "";
    //echo $time;
    $str = date('Y-m-d', $time);
    return $str;
}
function get_adgroup_name($ID) {
    $str = "";
    $m   = M('adteam');
    $ad  = $m->where('ID=' . $ID)->find();
    $str = $ad['Name'];
    return $str;
}

function getTelCode($len = 6) {
    $srcstr = "0123456789";
    mt_srand();
    $strs = "";
    for ($i = 0; $i < $len; $i++) {
        $strs .= $srcstr[mt_rand(0, 9)];
    }
    return $strs;
}

/*
 * 页面跳转
 * @param $url String
 * @param $type String
 * @param $msg String
 * @Param $time int
 * @return NULL
 */
function toPage($url) {
    if (empty($url)) {
        return false;
    }
    header("location: {$url}");
    exit;
}

/*
 * 页面跳转
 * @param $url String
 * @param $type String
 * @param $msg String
 * @Param $time int
 * @return NULL
 */
function jumpPage($url, $type = 'meta', $msg = '正在跳转', $time = 3) {
    if (empty($url)) {
        return false;
    }
    switch (strtolower($type)) {
        case 'meta'://meta标签跳转
            echo '<meta http-equiv="refresh" content="' . $time . '; url=' . $url . '"> ' . $msg;
            break;
        case 'header'://header跳转
            sleep($time);
            header("location: {$url}");
            break;
        case '301'://301页面跳转
            sleep($time);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location:{$url}");
            break;
        case 'js'://js方式跳转
            sleep($time);
            echo '<script language="javascript"> window.location= "' . $url . '";</script>';
            break;
        default://默认301方式跳转
            sleep($time);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location:{$url}");
            break;
    }
    exit;
}

/*
 * Json转数组
 * @param $data String or Object
 * @return Array
 */
function toArray($json) {
    return json_decode($json, true);
}

/*
 * 数组转Json
 * @param $data Array or String
 * @return String
 */
function toJson($data) {
    return json_encode($data);
}

/*
 * 对象转数组
 * @param $data Object
 * @return Array
 */
function objectToArray($object = null) {
    if (empty($object)) {
        return false;
    }
    $data = array();
    foreach ($object as $key => $val) {
        $data[$key] = $val->attributes;
    }
    return $data;
}

/*
 * 页面跳转会话
 */
function Msg($msg, $url = '', $time = 3, $type = 1) {
    if (empty($msg)) {
        $msg = '操作成功';
    }
    if (empty($url)) {
        $url = 'javascript:history.back(-1)';
    }

    $code = '<!DOCTYPE>
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=7" />
        <title>提示信息</title>
        <style type="text/css">
        <!--
        *{ padding:0; margin:0; font-size:12px}
        a:link,a:visited{text-decoration:none;color:#0068a6}
        a:hover,a:active{color:#ff6600;text-decoration: underline}
        .showMsg{border: 1px solid #1e64c8; zoom:1; width:450px; height:172px;position:absolute;top:44%;left:50%;margin:-87px 0 0 -225px}
        .showMsg h5{background-image: url("/Public/common/images/msg.png");background-repeat: no-repeat; color:#fff; padding-left:35px; height:25px; line-height:26px;*line-height:28px; overflow:hidden; font-size:14px; text-align:left}
        .showMsg .content{ padding:46px 12px 10px 45px; font-size:14px; height:64px; text-align:left}
        .showMsg .bottom{ background:#e4ecf7; margin: 0 1px 1px 1px;line-height:26px; *line-height:30px; height:26px; text-align:center}
        .showMsg .ok,.showMsg .guery{background: url("/Public/common/images/msg_bg.png") no-repeat 0px -560px;}
        .showMsg .guery{background-position: left -460px;}
        -->
        </style>
        </head>
        <body>
        <div class="showMsg" style="text-align:center">
            <h5>提示信息</h5>
            <div class="content guery" style="display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline;max-width:330px">' . $msg . '<b id="wait">' . $time . '</b> 秒后 跳转</div>
            <div class="bottom"><a href="' . $url . '" id="href">如果您的浏览器没有自动跳转，请点击这里</a></div>
        </div>
        <script type="text/javascript">
        var wait = document.getElementById(\'wait\'),href = document.getElementById(\'href\').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time == 0) {
                if(href != "" && href != null && href != "undefined"){
                    window.location.href = href;
                }else{
                    window.location.href = window.history.go(-1);
                }
                clearInterval(interval);
            };
        }, 1000);
        </script>
        </body>
        </html>';
    exit($code);
}

//AJAX显示窗口
function show_msg_win($type = 'success', $jumpurl = '', $msg = '') {
    if (empty($msg)) {
        $msg = '操作成功';
    }

    $code = '<div class="win_msg" style="position: absolute;top:50%;left:50%;padding:25px;background:#fff;"><p>' . $msg . '</p></div>';
    $code .= '<script>';
    $code .= 'var dom = $(".win_msg");$(".win_msg").css({"margin-top":-(dom.height()/2)});';
    $code .= '$(".win_msg").css({"margin-left":-(dom.width()/2)});';
    $code .= 'setTimeout(function(){dom.hide();';
    if ($jumpurl) {
        $code .= 'window.location.href="' . $jumpurl . '"';
    }
    $code .= '},3000);';
    $code .= '</script>';


    return $code;

}

/*
 * 获取Url参数
 * @param $key String
 * @param $type String
 * @rerun String
 * */
function getParam($key, $type = '') {
    if (empty($key)) {
        return false;
    } else {
        $result = isset($_REQUEST[$key]) ? $_REQUEST[$key] : '';
        switch (strtolower($type)) {
            case 'intval':
                $result = intval($result);
                break;
            case 'trim':
                $result = trim($result);
                break;
            case 'rtrim':
                $result = rtrim($result);
                break;
            case 'ltrim':
                $result = ltrim($result);
                break;
        }
        return $result;
    }
}

/**
 * 获取文件后缀名
 */
function get_extension($file)
{
    return substr(strrchr($file, '.'), 1);
}

/**
 * 价格格式
 * @param  [float]  $num   价格
 * @param  [int] $ishid 是否隐藏
 * @return [int]      是否隐藏 默认隐藏
 */
function parsePrice($num, $ishide = 1) {
    if ($ishide) {
        $Temp = str_split($num);
        $str  = '';
        $i    = 0;
        foreach ($Temp as $v) {
            if (is_numeric($v) && $i < 2) {
                $str .= '*';
                $i++;
            } else {
                $str .= $v;
            }
        }
        return $str;
    } else {
        return $num;
    }
}

/**
 * 天,s 剩余多少天进1
 * @param  [float]  $num   价格
 * @param  [int] $ishid 是否隐藏
 * @return [int]      是否隐藏 默认隐藏
 */
function showDay($time){
    if(empty($time)){
        return false;
    } else {
        $time = $time;
        $time_now = time();
        $time_data = $time-$time_now;
        $day = ceil($time_data/(60*60*24));
        return $day;
    }
}

/**
 * @param $url
 * @param string $data
 * @param string $type  返回类型 array json
 * @return mixed
 * curl get方式Http请求封装
 */
function curlGet($url,$data='',$type='array'){
    if(is_array($data)){
        $url = $url.'?'.http_build_query($data);
    }elseif(is_string($data) && !empty($data)){
        $url = $url.'?'.$data;
    }

    //初始化
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch,CURLOPT_TIMEOUT,15);
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);

    //记录非正常接口日志信息
    if($httpCode != 200){
        \Think\Log::write('接口状态：'.$httpCode.' URL地址：'.$url.', 参数:'.json_encode($data));
    }

    if($type == 'json'){
        return $result;
    }else{
        return json_decode($result,true);
    }
}

/**
 * @param $url
 * @param array $data
 * @param array $json  json格式访问
 * @param string $type 返回类型 array json
 * @return mixed
 * curl  post方式Http请求封装
 */
function curlPost($url, $data = array(), $json = false, $type = 'array')
{

    $ch = curl_init();
    if ($json) { //发送JSON数据
        $headers = array('Content-Type: application/json; charset=utf-8');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if (is_array($data)) {
            $data = json_encode($data);
        }
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    //记录非正常接口日志信息
    if ($httpCode != 200) {
        \Think\Log::write('接口状态：' . $httpCode . ' URL地址：' . $url . ', 参数:' . json_encode($data));
    }
    if ($type == 'json') {
        return $result;
    } else {
        return json_decode($result, true);
    }
}

/**
 * 获取客户端IP地址
 * @param Null
 * @return String
 */
function getIP() {
    $ip_address = '0.0.0.0';
    if (!empty($_SERVER['HTTP_CDN_SRC_IP'])) {
        $ip_address = $_SERVER['HTTP_CDN_SRC_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) AND isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if ($ip_address === 'Unknown') {
        $ip_address = '0.0.0.0';
        return $ip_address;
    }
    if (strpos($ip_address, ',') !== 'Unknown') {
        $x = explode(',', $ip_address);
        $ip_address = trim(end($x));
    }
    return $ip_address;
}

/*
 * url转换
 * @param Null
 * @return String
 */
function format_url($url)
{
    if(!$url)
    {
        return U('/');
    }
    else if( strpos($url,'-')!==false)
    {
        return U(str_replace('-','/',$url));
    }
}

/*
 * //根据概率获取奖项id
 * @$proArr arr
 * @return 返回值的id
 */
function get_rand($proArr) {
    $result = '';
    //概率数组的总概率精度
    $proSum = array_sum($proArr);
    //概率数组循环
    foreach ($proArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) {
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset ($proArr);
    return $result;
}