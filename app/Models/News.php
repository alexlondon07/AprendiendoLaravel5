<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    
	public $table = "news";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "title",
		"summary",
		"full_news",
		"publication_date",
		"author",
		"enable"
	];

	public static $rules = [
	    "title" => "required",
		"summary" => "required",
		"full_news" => "required",
		"publication_date" => "required",
		"enable" => "required"
	];

}
