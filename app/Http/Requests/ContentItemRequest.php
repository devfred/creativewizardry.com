<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContentItemRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        return [
            'title' => 'required|min:2',
            'content' => 'required',
            'excerpt' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tag_list' => 'required',
            'slug' => 'required|unique:content_items,slug,'.$this->segment(3)
        ];
	}

}
