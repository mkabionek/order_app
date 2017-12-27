<div class="container">
    <div class="row">
        <div class="order-block">
            <form class="order-form" method="POST" action="/order/insert">
                <div class="field"><h1>New order</h1></div>
                <div class="field">
                    <label for="">Title</label>
                    <input type="text" name="title" placeholder="Title" value="">
                </div>

                <div class="field">
                    <label for="">Info</label>
                    <textarea name="info" rows="10"></textarea>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-6 field">
                        <label for="">Category</label>
                        <select name="category">
                            <?php foreach ($data['categories'] as $category) {
                                echo "<option value='".$category['id']."'>".$category['category']."</option>";}?>
                        </select>
                    </div>

                    <div class="col-sm-6 col-md-6 field">
                        <label for="">Type</label>
                        <select name="type">
                            <?php foreach ($data['types'] as $type) {
                                echo "<option value='".$type['id']."'>".$type['type']."</option>";}?>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <button class="btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>