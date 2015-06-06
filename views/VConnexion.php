<form id="frmConnexion" name="frmConnexion" class="login">
    <p>
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" placeholder="login">
    </p>

    <p>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="password">
    </p>

    <p class="login-submit">
        <button type="button"  value="Valider" id="btValider" class="login-button">Login</button>
    </p>

    <p class="forgot-password"><a id="inscription" href="#">Pas encore inscrit ?</a></p>
</form>

<script type="text/javascript">

    function showSuccessToast() {
        $().toastmessage('showSuccessToast', "Inscription réussi ! Merci de vous authentifier.");
    }
    function messageBienvenue() {
        $().toastmessage('showSuccessToast', "Bienvenue sur triviaMMC ! Bonne chance.");
    }
    function showStickySuccessToast() {
        $().toastmessage('showToast', {
            text     : 'Success Dialog which is sticky',
            sticky   : true,
            position : 'top-right',
            type     : 'success',
            closeText: '',
            close    : function () {
                console.log("toast is closed ...");
            }
        });

    }
    function showNoticeToast() {
        $().toastmessage('showNoticeToast', "Notice  Dialog which is fading away ...");
    }
    function showStickyNoticeToast() {
        $().toastmessage('showToast', {
            text     : 'Notice Dialog which is sticky',
            sticky   : true,
            position : 'top-right',
            type     : 'notice',
            closeText: '',
            close    : function () {console.log("toast is closed ...");}
        });
    }
    function showWarningToast() {
        $().toastmessage('showWarningToast', "Warning Dialog which is fading away ...");
    }
    function showStickyWarningToast() {
        $().toastmessage('showToast', {
            text     : 'Warning Dialog which is sticky',
            sticky   : true,
            position : 'top-right',
            type     : 'warning',
            closeText: '',
            close    : function () {
                console.log("toast is closed ...");
            }
        });
    }
    function showErrorToast() {
        $().toastmessage('showErrorToast', " Identifiant ou mot de passe incorrect ! ");
    }
    function showStickyErrorToast() {
        $().toastmessage('showToast', {
            text     : 'Charles i y a un putin d erreur :/',
            sticky   : true,
            position : 'top-right',
            type     : 'error',
            closeText: '',
            close    : function () {
                console.log("toast is closed ...");
            }
        });
    }
    function showErrorToast2() {
        $().toastmessage('showErrorToast', " Impossible de se défier sois même ! ");
    }



</script>