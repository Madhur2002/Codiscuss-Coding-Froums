<div class="modal fade" id="Login Modal" tabindex="-1" role="dialog" aria-labelledby="Login ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Login ModalLabel">Log-in to your account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/idiscussforums/partials/handleLogin.php" method="POST">
                    <div class="form-group">
                        <label for="loginEmail">UserName</label>
                        <input type="text" class="form-control" id="loginEmail" name="loginEmail"
                            aria-describedby="emailHelp" placeholder="Enter username">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="loginPass">Password</label>
                        <input type="password" class="form-control" id="loginPass" name="loginPass"
                            placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Log-in</button>
                </form>
            </div>

        </div>
    </div>
</div>