<div id='edit-modal' class='modal hidden'>

    <div id='window' class='window'>

        <p class='modal-title'>管理者プロフィール編集</p>

        <ul>
            <!-- 更新: 画像ファイルの処理があるためenctype="multipart/form-data"を追記 -->
            <form method="POST" action="{{ route('admin.profile.edit', ['id' => $admins->id]) }}" enctype="multipart/form-data">
            <!-- PATCHメソッドを指定する -->
            @method('PATCH')
            <!------------------------------------------------->
                <!--CSRFトークン-->
                @csrf

                <li>
                    <label name='images' >
                        <input id="file-input" name='images' type="file" accept='.jpg,.jpeg,.png,.webp,.svg'>
                        <img id="preview-img" name='images' src="{{ asset('storage/images/admin/'.$admins->image) }}" alt="{{ $admins->account_id }}">
                    </label>
                </li>

                <li>
                    <!--アカウント名: マイページに表示される名前-->
                    <label>
                        名前
                        <input type="text" name="name" value='{{ $admins->name }}'>
                    </label>
                    <!--エラーハンドリング-->
                    @if ($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </li>
                <li>
                    <!--メールアドレス-->
                    <label>
                        メールアドレス
                        <p>* 空欄の場合は現在のメールアドレスになります</p>
                        <input type="text" name="email">
                    </label>
                    <!--エラーハンドリング-->
                    @if ($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </li>
                <li>
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
                            <p class="help-block">* システム管理者のみ編集可</p>
                            <input type="text" name="place" value="{{ $admins->place }}" readonly class='disable'>
                        @endif
                    </label>
                    <!--エラーハンドリング-->
                    @if ($errors->has('place'))
                        <p class="help-block">
                            {{ $errors->first('place') }}
                        </p>
                    @endif
                </li>
                <li>
                    <!--エリア(地方)-->
                    <label>
                        エリア
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
                            <p class="help-block">* システム管理者のみ編集可</p>
                            <input type="text" name="area" value="{{ $admins->area }}" readonly class='disable'>
                        @endif
                    </label>
                    <!--エラーハンドリング-->
                    @if ($errors->has('area'))
                        <p class="help-block">
                            {{ $errors->first('area') }}
                        </p>
                    @endif
                </li>
                <li>
                    <!--パスワード認証-->
                    <label>
                        ログインユーザーのパスワード
                        <input type="password" name="password">
                    </label>
                    <!--エラーハンドリング-->
                    @if ($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </li>
                <li>
                    <p class='submit'>
                        <button type="submit">更新</button>
                        <a href="{{ route('admin.profile.cancel', ['id' => $admins->id]) }}">キャンセル</a>
                    </p>
                </li>
                
            <!------------------------------------------------->
            </form>
            
        </ul>

    </div>

    <div id='edit-close' class='black'></div>


</div>