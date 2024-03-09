<fieldset>
    <legend>目前位置 : 首頁 > 最新文章區</legend>
    <table>
        <tr>
            <th>標題</th>
            <th>內容</th>
            <th></th>
        </tr>
        <?php
        $total = $News->count(['sh' => 1]);
        $div = 5;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;

        $rows = $News->all(['sh' => 1], " limit $start, $div");
        foreach ($rows as $row) {

        ?>

            <tr>
                <td class="clo">
                    <div style="cursor: pointer;" class="title" data-id="<?= $row['id']; ?>">
                        <?= $row['title']; ?>
                    </div>
                </td>
                <td>
                    <div id="s<?= $row['id']; ?>">
                        <?= mb_substr($row['news'], 0, 25); ?>
                    </div>
                    <div id="a<?= $row['id']; ?>" style="display:none">
                        <?= $row['news']; ?>
                    </div>
                </td>
                <td>

                </td>
            </tr>
        <?php
        }
        ?>
    </table>

    <?php
    if (($now - 1) > 0) {
        $prev = $now - 1;
        echo "<a href='?do=news&p=$prev'> < </a>";
    }

    for ($i = 1; $i <= $pages; $i++) {
        $fontsize = ($i == $now) ? 'font-size:22px' : 'font-size:16px';
        echo "<a href='?do=news&p=$i' style='$fontsize'> $i </a>";
    }

    if (($now + 1) >= $pages) {
        $next = $now + 1;
        echo "<a href='?do=news&p=$next'> > </a>";
    }
    ?>
</fieldset>

<script>
    $(".title").on('click', function(){
        let id=$(this).data('id')
        $(`#s${id},#a${id}`).toggle();
        // 用``允許同時寫字串和變數和一般的引號不一樣
    })
</script>