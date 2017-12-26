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
//                print_r($data['orders']);
                foreach ($data['orders'] as $order) {
                    echo "<tr><td>".$order['title']."</td>";
                    echo "<td>".$order['type']."</td>";
                    echo "<td>".$order['category']."</td>";
                    echo "<td>".$order['info']."</td>";
                    echo "<td>".$order['username']."</td>";
                    echo "<td><form action='/order/accept/".$order['order_id']."'><button class='btn'>Biere</button></form></td> </tr>";
                }



                ?>
<!--                <td>Titleeeeeeee eeeeeeeeekldf sfj;lksdjlkfjldsk jflksdjlfklsdk jflsdjlfjsdllkds lkfjcsjdfsjdlf</td>-->
<!--                <td>type</td>-->
<!--                <td>Category</td>-->
<!--                <td>Chief Sandwich sdfjkldsj sl;kdfjkld ;fdjskd ;f sdfdsfflkjdsl;f Eater</td>-->
<!--                <td><form action='/order/accept/asdasd'><button class='btn'>Biere</button></form></td>-->
<!--            </tr>-->


            </tbody>
        </table>
    </div>
</div>