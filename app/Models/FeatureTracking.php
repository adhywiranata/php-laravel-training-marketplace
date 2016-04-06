<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureTracking extends Model {

	protected $table = 'feature_tracking';

	public $timestamps = true;

	protected $fillable = [
			'feature_name',
			'user_id',
			'ip',
	];

	protected $guarded = [];

}
