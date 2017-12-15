<div class="container">
    <div class="row">
        <?php
            foreach ($data['orders'] as $order) {
                echo "<div class='col-sm-4 col-md-3'>";
                echo "<div class='item'>";
                echo "<div class='thumbnail'><img src='".$order['thumbnail']."'></div>";

                echo "<div class='caption'>";
                echo "<h3><a href='/order/show/".$order['id']."'>".$order['title']."</a></h3>";
                echo "<h7>".$order['status']."</h7>";
                echo "<p>".$order['description']."</p>";
                echo !empty($order['url'])?"<a class='btn download' href='".$order['url']."' download>
                                <i class='fa fa-download'></i> Download</a>": "";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        ?>
    </div>
</div>