<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
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
            'name' => 'required',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png|max:1500',
            'category_id' => 'required',
            'condition_id' => 'required',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名は必須です。',
            'description.required' => '商品説明は必須です。',
            'description.max' => '商品説明は最大255文字まで入力できます。',
            'image.required' => '商品画像をアップロードしてください。',
            'image.image' => 'アップロードするファイルは画像である必要があります。',
            'image.mimes' => '商品画像はJPEGまたはPNG形式でアップロードしてください。',
            'category_id.required' => '商品のカテゴリーを選択してください。',
            'condition_id.required' => '商品の状態を選択してください。',
            'price.required' => '商品価格は必須です。',
            'price.numeric' => '商品価格は数値で入力してください。',
            'price.min' => '商品価格は0円以上に設定してください。',
        ];
    }
}


