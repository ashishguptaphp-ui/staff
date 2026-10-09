<div class="modal fade"
     id="sessionModal"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title">

                    ⏳ Session Expiring

                </h5>

            </div>

            <div class="modal-body text-center">

                <h4 class="text-danger">

                    Your session will expire in

                </h4>

                <h1 id="countdown" class="display-3">

                    60

                </h1>

                <p>

                    Click <strong>Continue Session</strong>
                    to keep working.

                </p>

            </div>

            <div class="modal-footer justify-content-center">

                <button
                    class="btn btn-success"
                    id="continueSession">

                    Continue Session

                </button>

                <a href="<?= $this->Url->build(['controller'=>'Users','action'=>'logout']) ?>"
                   class="btn btn-danger">

                    Logout

                </a>

            </div>

        </div>

    </div>

</div>
<script>
  const sessionTimeout = 15 * 60 * 1000;
const warningTime = 14 * 60 * 1000;

let warningTimer;
let logoutTimer;
let countdownTimer;
let seconds = 60;

function resetSessionTimer(){

    clearTimeout(warningTimer);
    clearTimeout(logoutTimer);
    clearInterval(countdownTimer);

    bootstrap.Modal.getInstance(
        document.getElementById('sessionModal')
    )?.hide();

    seconds = 60;

    warningTimer = setTimeout(showWarning, warningTime);

}

function showWarning(){

    let modal = new bootstrap.Modal(
        document.getElementById('sessionModal')
    );

    modal.show();

    seconds = 60;

    document.getElementById("countdown").innerHTML = seconds;

    countdownTimer = setInterval(function(){

        seconds--;

        document.getElementById("countdown").innerHTML = seconds;

        if(seconds<=0){

            clearInterval(countdownTimer);

            window.location.href="/users/logout";

        }

    },1000);

}
document
.getElementById("continueSession")
.addEventListener("click",function(){

    fetch("/users/refreshSession",{

        method:"POST",

        headers:{
            "X-CSRF-Token":
                $('meta[name="csrfToken"]').attr("content")
        }

    })
    .then(r=>r.json())
    .then(function(){

        bootstrap.Modal
        .getInstance(
            document.getElementById('sessionModal')
        )
        .hide();

        resetSessionTimer();

    });

});
[
'click',
'mousemove',
'keydown',
'scroll',
'touchstart'
].forEach(function(event){

    document.addEventListener(event,function(){

        resetSessionTimer();

    });

});

resetSessionTimer();
  </script>