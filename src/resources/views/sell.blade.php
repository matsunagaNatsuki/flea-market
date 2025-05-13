@extend('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/sell.css') }}">
@endsection

@section('content')
<div class="sell-form">
    <h1 class="sell-form__heading content__heading">商品の出品</h1>
    <div class="sell-form__inner">
        <form class="sell-form__form" action="/sell" method="post" enctype="multipart/form-data">
            @csrf

            <div class="sell-form__image">
                <label class="sell-form__label" for="image">商品画像を選択する</label>
                <input class="sell-form__input" type="file" name="image" id="image">
            </div>

            <div class="sell-detail__form">
                <h2 class="sell-detail__heading content_heading">商品の詳細</h2>

                <div class="sell-detail__form group">
                    <label class="sell-detail__label" for="category">カテゴリー</label>
                    <input class="sell-detail__input" type="text" id="category" name="name" autocomplete="off">
                </div>

                <label for="condition_id">商品の状態</label>
                <select name="condition_id" id="condition_id" required>
                    <option value="" disabled selected>選択してください</option>
                    @foreach ($conditions ?? [] as $condition)
                        <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                </select>



            </div>

        </form>
    </div>
</div>