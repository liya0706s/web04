<fieldset>
    <legend>目前位置 : 首頁 > 最新文章 </legend>
    <table>
        <tr>
            <td>標題</td>
            <td>內容</td>
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
                <td class="clo" style="cursor:pointer">
                    <?= $row['title']; ?>
                </td>
                <td>
                    <div>
                        <?= mb_substr($row['news'], 0, 25); ?>
                    </div>
                    <div>
                        <?=$row['news'];?>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>

    <div>
        <?php
        if (($now - 1) > 0) {
            $prev = $now - 1;
            echo "<a href='?do=news&p=$prev'> < </a>";
        }

        for ($i = 1; $i <= $pages; $i++) {
            $fontsize = ($i==$now) ? 'font-size:20px' : 'font-size:16px';
            echo "<a href='?do=news&p=$i' style='$fontsize'> $i </a>";
        }

        if (($now + 1) >= $pages) {
            $next = $now + 1;
            echo "<a href='?do=news&p=$next'> > </a>";
        }

        ?>
    </div>


</fieldset>