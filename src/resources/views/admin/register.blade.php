@extends('admin.app')

@section('component')
    @vite(['resources/sass/auth/auth.scss', 'resources/ts/vanilla/permission.js'])
@endsection

@section('title', '新規登録')

@section('content')

    <div>

        <p class='title'>新規登録</p>

        <p class="alert-success">* 配属先とエリアは現在のアカウントと同じ情報が選択されています</p>
        @if (Auth::guard('admin')->user()->system_permission !== 1)
            <p class="alert-success">* システム管理者でないため同じ所属会社で固定になります</p>
        @endif

        <form method="POST" action="{{ route('admin.register') }}">
            <!------------------------------------------------->
            <!--CSRFトークン-->
            @csrf

            <!--アカウント名: マイページに表示される名前-->
            <label>
                名前
                <input type="text" name="name">
            </label>
            <!--エラーハンドリング-->
            @if ($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif

            <!--メールアドレス-->
            <label>
                メールアドレス
                <input type="text" name="email">
            </label>
            <!--エラーハンドリング-->
            @if ($errors->has('email'))
                <p class="help-block">
                    {{ $errors->first('email') }}
                </p>
            @endif

            <!--所属会社: システム管理者でない場合は自分の所属会社で固定 -->
            <label>
                所属会社 *
                @if (Auth::guard('admin')->user()->system_permission === 1)
                <!-- システム管理者のみ編集できるようにする -->
                    <select name="place">
                        <!--Model->Controllerで取得した配列を出力-->
                        @foreach($place_list as $option_place)
                            <!-- デフォルトで今ログインしているアカウントと同じ配属先にする -->
                            @if($option_place === $admins->place)
                                <option value='{{ $option_place }}' selected>{{ $option_place }}</option>
                            @else
                                <option value='{{ $option_place }}'>{{ $option_place }}</option>
                            @endif
                        @endforeach
                    </select>
                @else
                    <input type="text" name="place" value="{{ $admins->place }}" readonly class='disable'>
                @endif
            </label>
            <!--エラーハンドリング-->
            @if ($errors->has('place'))
                <p class="help-block">
                    {{ $errors->first('place') }}
                </p>
            @endif

            <!--エリア(地方)-->
            <label>
                エリア *
                @if (Auth::guard('admin')->user()->system_permission === 1)
                <!-- システム管理者のみ編集できるようにする -->
                    <select name="area">
                        <!--Model->Controllerで取得した配列を出力-->
                        @foreach($area_list as $option_area)
                            <!-- デフォルトで今ログインしているアカウントと同じエリアにする -->
                            @if($option_area === $admins->area)
                                <option value='{{ $option_area }}' selected>{{ $option_area }}</option>
                            @else
                                <option value='{{ $option_area }}'>{{ $option_area }}</option>
                            @endif
                        @endforeach
                    </select>
                @else
                    <input type="text" name="area" value="{{ $admins->area }}" readonly class='disable'>
                @endif
            </label>
            <!--エラーハンドリング-->
            @if ($errors->has('area'))
                <p class="help-block">
                    {{ $errors->first('area') }}
                </p>
            @endif

            <!--権限設定-->
            <!--チェックボックスが選択された状態でリクエスト送信された時にvalueの値を渡す-->
            <p class="check">
                <!--User管理権限-->
                <label class='checkbox'>
                    <input type="checkbox" id="user-permission" name="user-permission" value=1 class='checkbox'>
                    利用ユーザーの編集権限
                </label>

                <!--Admin管理権限-->
                <label class='checkbox'>
                    <input type="checkbox" id="admin-permission" name="admin-permission" value=1 class='checkbox'>
                    管理者の編集権限
                </label>
            </p>
            <p class='check'>
                <!--システム管理者権限-->
                <label class='checkbox'>
                    <input type="checkbox" id="system-permission" name="system-permission" value=1 class='checkbox'>
                    システム管理者権限
                </label>
                <span id='description' class="help-block hidden">
                    * 全利用ユーザー及び全管理者の編集権限を持つアカウントとして登録します
                </span>
            </p>

            <p class='submit'>
                <button type="submit">登録</button>
            </p>
            <!------------------------------------------------->

        </form>

    </div>

@endsection

@section('script')
    
@endsection
