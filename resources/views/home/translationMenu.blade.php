@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Menus</h2>
    <div class="row">
        <div class="col-md-6">
          <img class="img-responsive" src="/images/game/menu/1.png">
        </div>
        <div class="col-md-6">
          <h4>Terms</h4>
          ユーザーランク: User Rank<br>
          ステータスピース: Star Piece<br>
          <input type="text" placeholder="Japanese">:<input type="text" placeholder="English">
          <button class="button">Add New Term</button>
        </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <textarea>
                        * Ensemble Square Induction Training
ユーザーランクを10に上げる
達成済み
GET
達成ボーナス ステータスピース(赤小)x30
フェスプロデュースユニットを編成する
達成済み
GET
達成ボーナス ステータスピース(青小)x30
マイルームでキャラを着せ替える
達成済み
GET
達成ボーナス ステータスピース(黄小)x30
章臣
●)
何かあればすぐに教えてください。報告、
連絡、相談。報連相は社会人の基本ですか
ら
引き継ぎコードを設定する
達成済み
GET
達成ボーナス育成チケット(中)x10
        </textarea>
      </div>
    </div>  
</div>
@endsection
