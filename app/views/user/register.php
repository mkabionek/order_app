<div class="container">
    <div class="row">
        <div class="login-block">


            <form class="login-form" method="POST" action="">
                <div class="field"><h1>Sign up</h1></div>
                <div id="error-explanation">
<!--                    --><?php //foreach ($user->getErrors() as $error) {
//                        echo "<p>".$error."</p>"; } ?>

                </div>
                <div class="field">
                    <label for="username" >Username:</label>
                    <input type="text" name="username" placeholder="Username" id="username" required/>
                </div>
                <div class="field">
                    <label for="email" >Email:</label>
                    <input type="email" name="email" placeholder="e-mail" id="email" required />
                </div>
                <div class="field">
                    <label for="password" >Password:</label>
                    <input type="password" name="password" placeholder="Password" id="password" required />
                </div>
                <div class="field">
                    <label for="password-confirmation" >Confirm Password:</label>
                    <input type="password" name="password-confirmation" placeholder="Confirm password" id="password-confirmation" required />
                </div>

                <div class="field">
                    <button class="btn" id="login-btn">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>