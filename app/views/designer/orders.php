<div class="container">
    <div class="row">
        <table class="orders-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Category</th>
                <th>User</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
//                echo '<pre>';
//            print_r($data['orders']);
                foreach ($data['orders'] as $order) {
                    echo "<tr><td><a href='/order/show/".$order['order_id']."'>".$order['title']."</a></td>";
                    echo "<td>".$order['type']."</td>";
                    echo "<td>".$order['category']."</td>";
                    echo "<td>".$order['username']."</td>";
                    if ($order['status_id'] == 0){
                        echo "<td><form action='/order/edit/".$order['order_id']."'><button class='btn'>Edit</button></form></td> ";
                    }else{
                        echo "<td>Order done</td>";
                    }
                    echo "</tr>";

                }
            ?>
            </tbody>
        </table>

    </div>
</div>