<fieldset>
    <legend>目前位置 : 首頁 > 問卷調查 </legend>
    <table class="ct" style="width:90%">
        <tr class="clo">
            <th>編號</th>
            <th>問卷題目</th>
            <th>投票總數</th>
            <th>結果</th>
            <th>狀態</th>
        </tr>
        <?php
        $rows = $Que->all(['subject_id' => 0]);
        foreach ($rows as $key => $val) {
        ?>
            <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $val['text']; ?></td>
                <td><?= $val['vote']; ?></td>
                <td>
                    <a href="?do=result&id=<?= $val['id']; ?>">結果</a>
                </td>
                <td>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo "<a href='?do=vote&id={$val['id']}'> 參與投票 </a>";
                    } else {
                        echo "請先登入";
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</fieldset>