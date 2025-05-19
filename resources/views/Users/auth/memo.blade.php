Laravelで「配信期間内のみボタンを活性化する」機能を実装する場合、以下のような手順で実現できます。以下は簡単な例です。

1. データベースに配信期間を設定

まず、配信期間を管理するために、例えばstart_dateとend_dateを含むカラムをテーブルに追加します。

Schema::table('campaigns', function (Blueprint $table) {
$table->dateTime('start_date');
$table->dateTime('end_date');
});

2. モデルでスコープを定義

現在の日時が配信期間内かどうかを判定するスコープを作成します。

use Carbon\Carbon;

class Campaign extends Model
{
public function scopeActive($query)
{
$now = Carbon::now();
return $query->where('start_date', '<=', $now)
    ->where('end_date', '>=', $now);
    }
    }

    3. コントローラーでデータを取得

    配信期間内のデータを取得し、ビューに渡します。

    use App\Models\Campaign;

    public function index()
    {
    $campaigns = Campaign::active()->get();
    return view('campaign.index', compact('campaigns'));
    }

    4. ビューでボタンを活性化

    Bladeテンプレートで、配信期間内かどうかを判定してボタンを活性化します。

    @foreach ($campaigns as $campaign)
    <div>
        <p>{{ $campaign->name }}</p>
        @if (now()->between($campaign->start_date, $campaign->end_date))
        <button class="btn btn-primary">参加する</button>
        @else
        <button class="btn btn-secondary" disabled>配信終了</button>
        @endif
    </div>
    @endforeach

    5. JavaScriptで動的に制御（オプション）

    フロントエンドでリアルタイムにボタンの状態を更新したい場合、JavaScriptを使用して現在時刻を監視し、ボタンの状態を切り替えることも可能です。

    document.querySelectorAll('.campaign').forEach(campaign => {
    const startDate = new Date(campaign.dataset.startDate);
    const endDate = new Date(campaign.dataset.endDate);
    const now = new Date();

    const button = campaign.querySelector('button');
    if (now >= startDate && now <= endDate) {
        button.disabled=false;
        button.classList.remove('btn-secondary');
        button.classList.add('btn-primary');
        } else {
        button.disabled=true;
        button.classList.remove('btn-primary');
        button.classList.add('btn-secondary');
        }
        });


        これで、配信期間内のみボタンを活性化する機能が実現できます！必要に応じて、デザインやロジックをカスタマイズしてくださいね。 😊