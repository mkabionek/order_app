<section>
    <div class="container jumbotron">
        <div class="row">
            <h1 class="">Hi <?php echo $_SESSION['username']; ?></h1>
            <div class="col-sm-12 col-md-6 md-center">
                <p>You can list new orders or view your orders.</p>

                <a class="btn login" href="/designer">New orders</a>
                <a class="btn register" href="/designer/orders">My orders</a>
            </div>
        </div>
    </div>
</section>