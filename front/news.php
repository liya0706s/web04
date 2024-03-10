<fieldset>
    <legend>目前位置 : 首頁 > 最新文章區</legend>
    <table style="width:95%; margin:auto;">
        <tr>
            <th style="width:30%">標題</th>
            <th style="width:50%">內容</th>
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
                <td style="cursor: pointer;" class="title clo" data-id="<?= $row['id']; ?>">
                    <?= $row['title']; ?>
                </td>
                <td>
                    <div id="s<?= $row['id']; ?>">
                        <?= mb_substr($row['news'], 0, 25); ?>
                    </div>
                    <div id="a<?= $row['id']; ?>" style="display:none">
                        <?= $row['news']; ?>
                    </div>
                </td>
                <!-- 根據登入狀態顯示按讚的程式 -->
                <td class="ct">
                    <?php
                    if (isset($_SESSION['user'])) {
                        if ($Log->count(['news' => $row['id'], 'acc' => $_SESSION['user']])) {
                            echo "<a href='Javascript:good({$row['id']})'> 收回讚 </a>";
                        } else {
                            echo "<a href='Javascript:good({$row['id']})'> 讚 </a>";
                        }
                    }
                    ?>
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
    $(".title").on('click', function() {
        let id = $(this).data('id');
        $(`#s${id}, #a${id}`).toggle();
    })

    function good(news) {
        $.post('./api/good.php', {
            news
        }, () => {
            location.reload();
        })
    }
</script>