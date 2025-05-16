$(function() {
    console.log("JavaScript読み取り成功");

    //　変数宣言
    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth() + 1; // JavaScriptでは0始まりなので+1

    disableHigherGradeButtons();

    // 初期選択の学年ID
    let gradeId = userGradeId;

    // 非活性状態にする処理（初期化時に実行）
    function disableHigherGradeButtons() {
        const currentUserGradeId = userGradeId; // ユーザーの学年IDを取得

        $('.grade_btn').each(function() {
            const btnGradeId = +$(this).data('grade-id');
            console.log("ボタンの grade-id:", btnGradeId); 
            console.log("ユーザーの学年ID:", userGradeId);
            if (btnGradeId > currentUserGradeId) {
                $(this).prop('disabled', true);
                $(this).addClass('disabled');
            } else {
                $(this).prop('disabled', false)
                $(this).removeClass('disabled');
            }
        });
    }

    //　月切り替え処理
    // 次の月
    $('#nextMonth').on("click", function () {
        if (currentMonth === 12) {
            currentMonth = 1;
            currentYear++;
        } else {
            currentMonth++;
        }
        updateMonthDisplay();
    });

    // 前の月
    $('#prevMonth').on("click", function () {
        if (currentMonth === 1) {
            currentMonth = 12;
            currentYear--;
        }
        else {
            currentMonth--;
        }
        updateMonthDisplay();
    });

    // 月の表示を更新
    function updateMonthDisplay() {
        $('#activeMonth').text(`${currentYear}年${currentMonth}月 スケジュール`);
        disableHigherGradeButtons();
        updateGradeButtonStates(); 
        loadCurriculumData(currentYear, currentMonth, gradeId);
    }


    //　学年切り替え
    function updateGradeButtonStates() {
        disableHigherGradeButtons();
        $('.grade_btn').off("click").on("click", function () {
            if ($(this).hasClass('disabled')) {
                console.log("この学年は非活性です");
                return; // 非活性状態のボタンがクリックされた場合は何もしない
            }
            const gradeName = $(this).text();
            const classList = ['elementary', 'junior', 'high'];

            let selectedClass = '';
            classList.forEach(c => {
                if ($(this).hasClass(c)) {
                    selectedClass = c;
                }
            });

            const $select = $('#selectedGrade');
            $select.text(gradeName);
            $select.removeClass(classList.join(' '));
            $select.addClass(selectedClass);

            $('.grade_btn').removeClass('selected');
            $(this).addClass('selected');

            gradeId = $(this).data('grade-id'); // 選択された学年IDを取得

            console.log("選択された学年ID:", gradeId);
        
            // 学年変更時にカリキュラムを再取得
            loadCurriculumData(currentYear, currentMonth,  gradeId);
        });
    }
    
    // カリキュラムデータの取得
    function loadCurriculumData(currentYear, currentMonth, gradeId) {    
        console.log("カリキュラムデータを取得：", currentYear, currentMonth, gradeId);
        // Ajaxリクエストを送信
        $.ajax({
            url: `/api/curriculum/${currentYear}/${currentMonth}/${gradeId}`,
            method: 'GET',
            data: { grade_id: gradeId },
            dataType: 'json',
            success: function (response) {
                console.log("カリキュラムAPIレスポンス:", response);
                const $curriculumList = $('#curriculum_list');
                $curriculumList.empty(); // 既存のリストをクリア

                if (response.length === 0) {
                    $curriculumList.append('<p class="no_curriculum">現在、カリキュラムはありません。</p>');
                    return;
                }

                response.forEach(function (curriculum) {
                    console.log("カリキュラムデータ:", curriculum);
                    let deliveryInfo = '';
                    if (curriculum.always_delivery_flg == 1) {
                        deliveryInfo = `<li><a href="/user/delivery/1">常時配信</a></li>`;
                    } else {
                        curriculum.delivery_times.forEach(deliveryTime => {
                            console.log('time オブジェクト:', deliveryTime);
                            deliveryInfo += `<li><a href="/user/delivery/1">${deliveryTime.formatted_from} ~ ${deliveryTime.formatted_to}</a></li>`;
                        });
                    }

                    // 配信予定がない場合はそのカリキュラムを表示しない
                    if (!deliveryInfo) {
                        return; // 配信情報がない場合は何も表示しない
                    }

                    const curriculumHtml = `
                        <div class="curriculum">
                            <img src="${curriculum.thumbnail}" alt="サムネイル" class="thumbnail">
                            <a href="/user/delivery/1" class="curriculum_title">${curriculum.title}</a>
                            <ul class="curriculum_times">
                                ${deliveryInfo}
                            </ul>
                        </div>
                    `;
                    $curriculumList.append(curriculumHtml);

                });
            },
            error: function (xhr, status, error) {
                console.log("ステータス: " + status);
                console.log("エラー: " + error);
                Swal.fire('エラー', 'カリキュラムの取得に失敗しました。', 'error');
            }
            
        });
    }
    // 初期表示のカリキュラムデータを取得

    updateGradeButtonStates();
});
