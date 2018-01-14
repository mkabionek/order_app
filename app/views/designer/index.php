<div class="container">
    <div class="row">
        <table class="orders-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Category</th>
                <th>Info</th>
                <th>User</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
<!--            <tr>-->
                <?php
//                echo '<pre>';
//                print_r($data['orders']);
                foreach ($data['orders'] as $order) {
                    echo "<tr><td>".$order['title']."</td>";
                    echo "<td>".$order['type']."</td>";
                    echo "<td>".$order['category']."</td>";
                    echo "<td>".$order['info']."</td>";
                    echo "<td>".$order['username']."</td>";
                    echo "<td><form action='/order/take/".$order['order_id']."'><button class='btn'>Accept</button></form></td> </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
</div>