<?php
class curl_help{
	private static $options=array();
	private static $ch;
	private static $mh=null;
	private static $handle;
	private static $header;
	private static $cookie;
	public static function init($url,$post=[],$cookie=[],$option=[]){
		self::option_set($option);
		self::set_post($post);
		self::set_url($url);
		self::set_cookie($cookie);
		
		if(is_array($url)){
			self::$mh = curl_multi_init();
			$i = 0;
			foreach($url as $val) {			
				self::set_url($val);
				self::get_init();
				curl_multi_add_handle(self::$mh, self::$ch);
				self::$handle[$i++] = self::$ch;
			}
			
		}else{
			self::get_init();
		}			
		return self::get_content();
	}
	private static function get_init(){
		self::$ch = curl_init();
		
		curl_setopt_array(self::$ch, self::$options);
	}
	private static function get_content(){
		if(self::$mh){
			do {
				curl_multi_exec(self::$mh, $running);
				curl_multi_select(self::$mh);
			} while ($running > 0);
			foreach(self::$handle as $i => $ch) {
				$content  = curl_multi_getcontent($ch);
				
				self::set_header($content);
				$data[$i] = (curl_errno($ch) == 0) ? $content : false;
			}
			foreach(self::$handle as $ch) {
				curl_multi_remove_handle(self::$mh, $ch);
			}
			curl_multi_close(self::$mh);
			return $data;
		}else{
			
			$result = curl_exec(self::$ch); 
			self::set_header($result);
			curl_close(self::$ch);
			return $result;
		}
	}
	private static function set_header(&$content){
		
		if($head=strstr($content,"\r\n\r\n", true)){	
			$content=str_replace($head,"",$content);
			if(self::$mh){
				self::$header[]=$head;
			}else{
				self::$header=$head;
			}
			
		}
	}
	private static function option_set($option=[]){
		
		foreach($option as $key=>$val){
			self::$options[$key]=$val;
		}
		self::$options[CURLOPT_HEADER]=0;
		self::$options[CURLOPT_RETURNTRANSFER]=1;
		
		self::$options[CURLOPT_FAILONERROR]=1;
		self::$options[CURLOPT_FOLLOWLOCATION]=1;
		
		self::$options[CURLOPT_USERAGENT]="Mozilla/5.0 (Windows NT 5.1; rv:10.0.2) Gecko/20100101 Firefox/10.0.2";//偽造成瀏覽器
		self::$options[CURLOPT_SSL_VERIFYPEER]=0;//https需要使用
		self::$options[CURLOPT_SSL_VERIFYHOST]=0;//https需要使用
		
		self::$options[CURLOPT_TIMEOUT]=15;
	}
	private static function set_url($url){
		self::$options[CURLOPT_URL]=$url;
	}
	private static function set_post($post){
		if(count($post)>0){
			self::$options[CURLOPT_POST]=1;
			self::$options[CURLOPT_POSTFIELDS]=http_build_query($post);
		}
	}
	private static function set_cookie($cookie){
		if(is_array($cookie)){
			if(count($cookie)>0){
				foreach($cookie as $key=>$val){
					$cookie_arr[]=$key.'='.$val;
				}
				self::$options[CURLOPT_COOKIE]=implode(";",$cookie_arr);
			}
		}elseif(is_string($cookie)){
			self::$options[CURLOPT_COOKIE]=$cookie;
		}
	}
	
	public static function parse_cookie($header){
		$cookie=[];
		if(preg_match_all('/Set-Cookie: (.+)\r\n?/',$header,$M)){
			foreach($M[1] as $val){
				list ($key, $value) = explode('=', $val);
				$cookie[$key]=$value;
			}
		}	
		return $cookie;
	}
	public static function gh(){
		return self::$header;
	}
	public static function gc(){
		
		if(is_array(self::$header)){
			$tmp=[];
			foreach(self::$header as $val){
				$tmp[]=self::parse_cookie($val);
			}
			return $tmp;
		}else{
			return self::parse_cookie(self::$header);
		}
		
	}
}
//$id=@$_GET['id'];
//
//if(!$id){
//    
//}

$url='https://graph.facebook.com/100002081915136/picture?width=300&height=300';
echo $data = curl_help::init($url);
//$data = file_get_contents($url);

//$base64 = 'data:image/' .'jpg'.';base64,'.base64_encode($data);
//
//echo $base64;

