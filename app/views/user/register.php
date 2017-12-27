<div class="container">
    <div class="row">
        <div class="form-block">


            <form class="login-form" method="POST" action="/user/create">
                <div class="field"><h1>Sign up</h1></div>
                <div id="error-explanation">
<!--                    --><?php //foreach ($user->getErrors() as $error) {
//                        echo "<p>".$error."</p>"; } ?>

                </div>
                <div class="field">
                    <label for="username" >Username:</label>
                    <input type="text" name="username" placeholder="Username" id="username" />
                </div>
                <div class="field">
                    <label for="email" >Email:</label>
                    <input type="email" name="email" placeholder="e-mail" id="email"  />
                </div>
                <div class="field">
                    <label for="password" >Password:</label>
                    <input type="password" name="password" placeholder="Password" id="password"  />
                </div>
                <div class="field">
                    <label for="password-confirmation" >Confirm Password:</label>
                    <input type="password" name="password-confirmation" placeholder="Confirm password" id="password-confirmation"  />
                </div>

                <div class="field">
                    <button class="btn" id="login-btn">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>