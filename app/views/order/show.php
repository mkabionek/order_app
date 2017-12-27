<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="thumbnail">
                <?php if (filter_var($data['order']['url'],FILTER_VALIDATE_URL)){
                   echo "<object data='".$data['order']['url']."' type=''></object>";
                }?>
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="item">
                <div class="caption">
                    <h3><?php echo $data['order']['title']; ?></h3>
                    <input id="order-id" type="hidden" value='<?php echo $data['order']['order_id'] ?>'>
                    <p class="field">Status: <?php echo $data['order']['status']; ?> </p>
                    <p class="field">Designer: <?php echo $data['order']['designer_name']; ?></p>
                    <p class="field">Category: <?php echo $data['order']['category']; ?> </p>
                    <p class="field">Type: <?php echo $data['order']['type']; ?> </p>
                    <p class="description"><?php echo $data['order']['description']; ?></p>
                    <!-- <button id="show-mods">modify</button> -->
                    <div class="accept-div">
                        <?php
                            if($data['order']['status_id']== 0){
                                if (isset($_SESSION['user_id']) && $data['order']['user_id'] == $_SESSION['user_id']){
                                    echo "<a class='btn accept' id='accept-btn'><i class='fa fa-check'></i> Accept</a>";
                                }
                            }
                        ?>
                        <a class='btn download' href='<?php echo $data['order']['url']; ?>' download><i class='fa fa-download'></i> Download</a>
                    </div>
                </div>
            </div>

            <div class="modification item hidden" id="mod-div">
                <textarea></textarea>
            </div>

        </div>
    </div>

</div>