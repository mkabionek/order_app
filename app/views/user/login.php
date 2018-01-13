<section>
    <div class="container">
        <div class="row">

            <div class="form-block">
                <form class="login-form" method="POST" action="/user/auth">
                    <div class="field"><h1>Login</h1></div>
                    <div class="field">
                        <label for="email" >Email:</label>
                        <input type="email" name="email" placeholder="e-mail" id="email" required />
                    </div>
                    <div class="field">
                        <label for="password">Password:</label>
                        <input type="password" placeholder="Password" id="password" name="password" required/>
                    </div>
                    <div class="field">
                        <button class="btn" id="login-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

