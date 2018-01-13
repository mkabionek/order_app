<section>
    <div class="container jumbotron">
        <div class="row">
            <h1 class="">Hi <?php echo $_SESSION['username']; ?></h1>
            <div class="col-sm-12 col-md-6 md-center">
                <p>You can add new order or review past orders.</p>

                <a class="btn login" href="/order/add">New</a>
                <a class="btn register" href="/order">View</a>
            </div>
        </div>
    </div>
</section>