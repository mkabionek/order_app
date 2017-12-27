<div class="container">

    <div class="row">
        <div class="order-block">
            <form class="order-form" method="POST" action="/order/update">
                <input type="hidden" name="order_id" value="<?php echo $data["order_id"] ?>">
                <div class="field"><h1>Edit order</h1></div>

                <div class="field">
                    <label for="">Title</label>
                    <input type='text' name='title' placeholder='Title' value='<?php echo $data["title"];?>'>
                </div>

                <div class="field">
                    <label for="">URL</label>
                    <input type='text' name='url' placeholder='URL' value='<?php echo $data["url"];?>'>
                </div>

                <div class="field">
                    <label for="">Thumbnail</label>
                    <input type='text' name='thumbnail' placeholder='thumbnail' value='<?php echo $data["thumbnail"];?>'>
                </div>

                <div class="field">
                    <label for="">Description</label>
                    <textarea name="description" rows="10"><?php echo $data["description"];?></textarea>
                </div>

                <div class="field">
                    <button class="btn">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>