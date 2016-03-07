<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class General extends Model {

	//

	function scopeSelects($query,$array)
	{
		if(isset($array['select'])):
			$query->select($array['select']);
		endif;

		$query->from($array['table']);

		if(isset($array['condition'])):
			foreach($array['condition'] as $where => $parameters):
				$query->where($parameters["column"],$parameters["comparison"],$parameters["value"]);
			endforeach;
		endif;

		if(isset($array['join'])):
			foreach($array['join'] as $join => $detail):
				$details = 	explode(" ",$detail['statement']);
				if($detail['type'] == 'left join'){
					$query->leftJoin($join,$details[0],$details[1],$details[2]);
				}else if($detail['type'] == 'join'){
					$query->join($join,$details[0],$details[1],$details[2]);
				}
			endforeach;
		endif;

		if(isset($array['limit'])):
			if($array['limit'] != '' ||$array['limit'] != 0){
				$query->limit($array['limit']);
			}
		endif;

		if(isset($array['offset'])):
			if($array['offset'] != '' ||$array['offset'] != 0){
				$query->offset($array['offset']);
			}
		endif;

		if(isset($array['orderBy'])):
			if(isset($array['orderType'])):
				if($array['orderType'] != '' ||$array['orderType'] != NULL):
					$query->orderBy($array['orderBy'],$array['orderType']);
				endif;
			else:
				if($array['orderBy'] != '' ||$array['orderBy'] != NULL):
					$query->orderBy($array['orderBy']);
				endif;
			endif;
		endif;

		return $query;
	}

	function scopeUpdates($query,$array)
	{
		$query->from($array['table']);
		$query->timestamps = $array['timestamps'];

		if(isset($array['condition'])):
			foreach($array['condition'] as $where => $value):
				$query->where($where,$value);
			endforeach;
		endif;

		$query->update($array['data'],'role');
	}

	function scopeCreates($query,$array)
	{
		$query->from($array['table']);
		$query->insert($array['data']);
	}

	function scopeDeletes($query,$array)
	{
		$query->from($array['table']);
		if(isset($array['condition'])):
			foreach($array['condition'] as $where => $value):
				$query->where($where,$value);
			endforeach;
		endif;
		$query->delete();
	}

}
