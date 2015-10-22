<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class NewsController extends AppBaseController
{

	/**
	 * Display a listing of the Post.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$query = News::query();
        $columns = Schema::getColumnListing('$TABLE_NAME$');
        $attributes = array();

        foreach($columns as $attribute){
            if($request[$attribute] == true)
            {
                $query->where($attribute, $request[$attribute]);
                $attributes[$attribute] =  $request[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        $news = $query->get();

        return view('news.index')
            ->with('news', $news)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new News.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('news.create');
	}

	/**
	 * Store a newly created News in storage.
	 *
	 * @param CreateNewsRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateNewsRequest $request)
	{
        $input = $request->all();

		$news = News::create($input);

		Flash::message('News saved successfully.');

		return redirect(route('news.index'));
	}

	/**
	 * Display the specified News.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$news = News::find($id);

		if(empty($news))
		{
			Flash::error('News not found');
			return redirect(route('news.index'));
		}

		return view('news.show')->with('news', $news);
	}

	/**
	 * Show the form for editing the specified News.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$news = News::find($id);

		if(empty($news))
		{
			Flash::error('News not found');
			return redirect(route('news.index'));
		}

		return view('news.edit')->with('news', $news);
	}

	/**
	 * Update the specified News in storage.
	 *
	 * @param  int    $id
	 * @param CreateNewsRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateNewsRequest $request)
	{
		/** @var News $news */
		$news = News::find($id);

		if(empty($news))
		{
			Flash::error('News not found');
			return redirect(route('news.index'));
		}

		$news->fill($request->all());
		$news->save();

		Flash::message('News updated successfully.');

		return redirect(route('news.index'));
	}

	/**
	 * Remove the specified News from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var News $news */
		$news = News::find($id);

		if(empty($news))
		{
			Flash::error('News not found');
			return redirect(route('news.index'));
		}

		$news->delete();

		Flash::message('News deleted successfully.');

		return redirect(route('news.index'));
	}
}
