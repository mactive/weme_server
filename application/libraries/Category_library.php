<?php
/**
 * ÊµÏÖÎÞÏÞ·ÖÀàµÄÔöÉ¾¸Ä²é£¬ÓÃÓÚcodeigniter¿ò¼Ü£¬Ò²¿ÉÒÔÐÞ¸ÄºóÓÃÓÚÆäËüÓÃÍ¾¡£
 * @author http://www.baiyuxiong.com
 *
 */
class Category_library {
	
	public $CI;
	
	//Òª²Ù×÷µÄ±íÃû
	public $tableName;
	
	//±íµÄÎå¸ö×Ö¶Î
	public $filedId;
	public $filedPid;
	public $filedCname;
	public $filedCdesc;
	public $filedClevel;
	public $filedCorder;
	public $filedCicon;
	
	//ÒªÈ¡µÄ·ÖÀàÉî¶È
	public $depth = 0;
	public $startLevel = 1;
	
	/**
	 * ¹¹Ôìº¯Êý
	 * @param $params ²ÎÊý°üÀ¨±íÃû£¬¼°·ÖÀà±íµÄÎå¸ö×Ö¶ÎÃû£¬Èç¹ûÃ»ÓÐ¶¨Òå£¬Ôò²ÉÓÃÄ¬ÈÏ£¬
	 * Ä¬ÈÏÖµ 	±íÃû£ºcategory	·ÖÀàID£ºcid	¸¸ID£ºpid	·ÖÀàÃû³Æ£ºcname	·ÖÀà¼¶±ð£ºclevel	·ÖÀàÅÅÐò£ºcorder
	 * corderÔÚÍ¬Ò»¸¸¼¶ÏÂÓÐ¶à¼¶Ê±£¬ÓÃÓÚÅÅÐò¡£
	 * ·ÀÖ¹µÝ¹é½øÐÐËÀÑ­»·£¬Ôö¼ÓÁËclevel£¬±íÊ¾µ±Ç°·ÖÀàµÄµÚ¼¸¼¶
	 */

	function __construct($params)
	{
		$this->CI =& get_instance();

		//³õÊ¼Ê¼»¯±í²ÎÊý
		$this->tableName = (isset($params['tableName']))?$params['tableName']:'source_category';
		$this->filedId = (isset($params['filedId']))?$params['filedId']:'id';
		$this->filedPid = (isset($params['filedPid']))?$params['filedPid']:'parent_id';
		$this->filedCname = (isset($params['filedCname']))?$params['filedCname']:'title';
		$this->filedCdesc = (isset($params['filedCdesc']))?$params['filedCdesc']:'desc';
		$this->filedClevel = (isset($params['filedClevel']))?$params['filedClevel']:'level';
		$this->filedCorder = (isset($params['filedCorder']))?$params['filedCorder']:'sort_order';		
		$this->filedCicon = (isset($params['filedCicon']))?$params['filedCicon']:'icon';		
		
	}
	/**
	 * È¡³öËùÓÐ·ÖÀà,·µ»ØÒ»¸öÊý×é£¬°üÀ¨·ÖÀàÃû³Æ¼°¼¶±ð£¬Ò»°ãÓÃÓÚÔÚselect¿òÀïÏÔÊ¾
	 * @param $pid ¸¸ID
	 * @param $widthself ²éÏÂ¼¶·ÖÀàµÄÊ±ºò£¬ÊÇ·ñ°üº¬×Ô¼º£¬Ä¬ÈÏfalse²»°üº¬¡£
	 * @param $depth ËùÈ¡·ÖÀàµÄÉî¶È;ÖµÎª0±íÊ¾²»ÏÞÉî¶È,»áÈ¡ËùÓÐµÄ×Ó·ÖÀà¡£
	 */
	function getAllCategory($pid = 0,$widthself = false,$depth = 0)
	{
		$result = array();
		$resArr = $this->fetchData();
		if(empty($resArr))
			return array();
		foreach ($resArr as $item)
		{
			if($item[$this->filedPid] == $pid)	
			{
				$level = $item[$this->filedClevel];
			}
			if($widthself)
			{
				if($item[$this->filedId] == $pid)	
				{
					$result[] = $item;
				}
			}
		}
		if(!isset($level))
			return array();
		$this->depth = $depth;
		$this->startLevel = $level;
		return array_merge($result,$this->getChildren($resArr,$pid,$level));
	}
	
	/**
	 * È¡³öÄ³Ò»·ÖÀàÏÂµÄËùÓÐID£¬pid=0Îª¸ùÔªËØ,Ò»°ãÓÃÓÚÈ¡³öÒ»¸ö·ÖÀàÏÂµÄÎÄÕÂµÈ
	 * @param $pid ¸¸ID
	 * @param $widthself È¡×Ó·ÖÀàÊ±£¬ÊÇ·ñ°üº¬×Ô¼º,Ä¬ÈÏ²»°üº¬
	 * @param $depth Òª¶ÁÈ¡µÄ²ã¼¶Éî¶È£¬Ä¬ÈÏ²é³öËùÓÐ×Ó·ÖÀà
	 */
	function getAllCategoryID($pid = 0,$widthself = false,$depth = 0)
	{
		$idArr = array();
		
		if($widthself)
		{
			array_push($idArr,$pid);
		}
		
		$cate = $this->getAllCategory($pid,$depth);
		foreach($cate as $item)
		{
			$idArr[] = $item[$this->filedId];
		}
				
		return $idArr;
	}

	/**
	 * ÓÃÓÚÔÚÏÂÀ­ÁÐ±í¿òÖÐÊ¹ÓÃ
	 * @param $pid ¸¸ID
	 * @param $widthself »òÈ¡×Ó·ÖÀàµÄÊ±ºòÊÇ·ñ»ñÈ¡±¾Éí
	 * @param $depth Éî¶È
	 */
	function getOptionStr($cid = 0,$pid = 0,$widthself = false,$depth = 0)
	{
		$str = '';
		$cate = $this->getAllCategory($pid,$widthself,$depth);
		
		if($cid){
			$currentInfo = $this->fetchOne($cid);
		}
		
		if (!empty($cate)) 
		{
			foreach($cate as $item)
			{
				if(!empty($cid)){
					$selected = ($item[$this->filedId] == $currentInfo[$this->filedPid]) ?  "selected" : ""  ; //显示当前项目
				}else{
					$selected = ""; //显示当前项目
				}
				
				$str.='<option value="'.$item[$this->filedId].'"'. $selected .'>'.str_repeat('&nbsp;',($item[$this->filedClevel]-$this->startLevel)*4).$item[$this->filedCname].'</option>';
			}
		}
		return $str;
	}
	
	/**
	 * ÓÃÓÚÁÐ±íÏÔÊ¾£¬°´ul li±êÇ©×éÖ¯
	 * @param $pid
	 * @param $widthself
	 * @param $depth
	 */
	function getListStr($pid = 0,$widthself = false,$depth = 0)
	{
		$str = '';
		$startLevel = -1;
		$preLevel = 0;
		$cate = $this->getAllCategory($pid,$widthself,$depth);
		if (!empty($cate)) 
		{
			foreach($cate as $item)
			{
				if($startLevel<0)
				{
					$startLevel = $item[$this->filedClevel];
				}
				if ($item[$this->filedClevel]<$preLevel) {
					$str .='</li>'.str_repeat('</ul></li>',$preLevel - $item[$this->filedClevel]);
				}
				elseif ($item[$this->filedClevel]>$preLevel) {
					$str .='<ul>';
				}	
				else
				{
					$str .='</li>';
				}	
						
				$str .= '<li><img src="'.$item[$this->filedCicon].'"/>'.$item[$this->filedCname].' <a href="'.site_url('category/edit/'.$item[$this->filedId]).'">edit</a>';
								
				$preLevel = $item[$this->filedClevel];
			}
		}
		//ÊÕÎ²
		$str .=str_repeat('</li></ul>',$preLevel - $startLevel+1);
		return $str;
	}
	/**
	 * Ôö¼Ó·ÖÀà
	 * @param $pid ¸¸ID
	 * @param $cname ·ÖÀàÃû³Æ
	 * @param $corder ÅÅÐò£¬ Ö»¶ÔÍ¬Ò»¼¶ÏÂµÄ·ÖÀàÓÐÓÃ
	 */
	function addCategory($pid,$cname,$cdesc,$corder,$cicon)
	{
		$pid = empty($pid) ? 0 : intval($pid) ; 
		//获得parent_id的信息
		$parentInfo = empty($pid) ? array($this->filedClevel => 0) : $this->fetchOne($pid);
		
		//整理数据
		$data = array(
			$this->filedPid		=>$pid,
			$this->filedCname	=>$cname,
			$this->filedClevel	=>$parentInfo[$this->filedClevel]+1,
			$this->filedCorder	=>$corder,
			$this->filedCdesc 	=>$cdesc,
			$this->filedCicon 	=>$cicon
		);
		
		//print_r($data);
		$this->CI->db->insert($this->tableName, $data);
	}
	
	/**
	 * ±à¼­·ÖÀà
	 * @param $cid	Òª±à¼­µÄ·ÖÀà
	 * @param $pid	·ÖÀàµÄ¸¸ID
	 * @param $cname ·ÖÀàµÄÃû³Æ
	 * @param $corder	·ÖÀàÅÅÐò
	 */
	function editCategory($cid,$pid,$cname,$cdesc,$corder,$cicon)
	{
		$pid = empty($pid) ? 0 : intval($pid) ; 
		//获得parent_id的信息
		$parentInfo = empty($pid) ? array($this->filedClevel => 0) : $this->fetchOne($pid);
		
		$currentInfo = $this->fetchOne($cid);
		$newLevel = $parentInfo[$this->filedClevel]+1;
		$levelDiff = $newLevel - $currentInfo[$this->filedClevel];

		//var_dump($levelDiff);

		//如何不等0 更新父亲类别
		if($levelDiff != 0 )
		{
			$childIDArr = $this->getAllCategoryID($cid);
			//var_dump($childIDArr);
			foreach($childIDArr as $item)
			{
				$this->CI->db->set($this->filedClevel, $this->filedClevel.'+'.$levelDiff, FALSE);
				$this->CI->db->where($this->filedId, $item);
				$this->CI->db->update($this->tableName); 
				echo $this->CI->db->last_query().'<br/>';
			}
		}
		//ÐÞ¸Ä×Ô¼ºµÄlevel
		$data = array(
			$this->filedPid=>$pid,
			$this->filedCname=>$cname,
			$this->filedCdesc=>$cdesc,
			$this->filedClevel=>$newLevel,
			$this->filedCorder=>$corder
		);
		if(!empty($cicon)){$data[$this->filedCicon]  = $cicon;}
		
		$this->CI->db->where($this->filedId, $cid);
		$this->CI->db->update($this->tableName, $data); 
		//echo $this->CI->db->last_query().'<br/>';				
		
	}
	
	/**
	 * É¾³ý·ÖÀà
	 * @param $cid ÒªÉ¾³ýµÄ·ÖÀàID
	 * @param $widthSub ÊÇ·ñÉ¾³ýÏÂÃæµÄ×Ó·ÖÀà£¬Ä¬ÈÏ»áÉ¾³ý
	 */
	function delCategory($cid,$widthSub = TRUE)
	{		
		if($widthSub)
		{
			$idArr = $this->getAllCategoryID($cid,true);
			$this->CI->db->where_in($this->filedId,$idArr);
		}
		else
		{
			$this->CI->db->where($this->filedId,$cid);
		}

		$this->CI->db->delete($this->tableName);		
	}
	
	
	/**
	 * ´ÓÊý¾Ý¿âÈ¡ËùÓÐ·ÖÀàÊý¾Ý£¬·µ»ØÊý×é
	 */
	function fetchData()
	{
		$query = $this->CI->db->get($this->tableName);
		$resArr = $query->result_array();
		if(empty($resArr))
		{
			return array();
		}
		return $resArr;
	}
	
	/**
	 * È¡Ä³Ò»Ìõ·ÖÀàÊý¾Ý
	 * @param $cid
	 */
	function fetchOne($cid)
	{
		$this->CI->db->where($this->filedId,$cid);
		$query = $this->CI->db->get($this->tableName);
		return $query->row_array(); 
	}
	
	/**
	 * °´Ë³Ðò·µ»Ø·ÖÀàÊý×é,ÓÃµÝ¹éÊµÏÖ
	 * @param unknown_type $catArr
	 * @param unknown_type $pid
	 * @param unknown_type $clevel
	 */
	private function getChildren($catArr,$pid=0,$clevel = 1)
	{
		if($this->depth !=0 && ($clevel >=($this->depth+$this->startLevel)))
			return;
		$resultArr = array();
		$childArr = array();
		
		//±éÀúµ±Ç°¸¸IDÏÂµÄËùÓÐ×Ó·ÖÀà
		foreach($catArr as $item)
		{
			if($item[$this->filedPid] == $pid && ($item[$this->filedClevel] == $clevel)) 
			{
				//½«×Ó·ÖÀà¼ÓÈëÊý×é
				$childArr[] = $item;
			}
		}

		if(count($childArr) == 0)
		{
			//²»´æÔÚÏÂÒ»¼¶£¬ÎÞÐè¼ÌÐø
			return;
		}
		//´æÔÚÏÂÒ»¼¶£¬°´orderÅÅÐòÏÈ
		usort($childArr,array('Category_library','compareByorder'));
		
		foreach($childArr as $item)
		{
			$resultArr[] = $item;
			$temp = $this->getChildren($catArr,$item[$this->filedId],($item[$this->filedClevel]+1));
			
			if(!empty($temp))
				$resultArr = array_merge($resultArr, $temp);			
		}		
		
		return $resultArr;
	}
	
	//±È½Ïº¯Êý,usortÓÃ
	private function compareByorder($a, $b)
	{
		if ($a == $b) {
            return 0;
        }
        return ($a[$this->filedCorder] > $b[$this->filedCorder]) ? +1 : -1;		
	}
	
}