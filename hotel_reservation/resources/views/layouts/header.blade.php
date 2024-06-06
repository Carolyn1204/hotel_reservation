

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <!-- Container wrapper -->
  <div class="container">
    

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" style="color: rgb(59 113 202); font-weight: 600;" href=" {{ url('/index') }} "><i class="fas fa-hotel"></i>&nbsp;Home</a>
        </li>
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center header"  style="margin-left:900px;">
        <button data-mdb-ripple-init type="button" class="btn btn-link px-3 me-2" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#staticBackdrop" id="header_login">
          Login
        </button>
        <button data-mdb-ripple-init type="button" class="btn btn-primary me-3" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#staticBackdropreg" id="header_registraion">
          Sign up for free
        </button>
      </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->




<!-- Modal Login -->
<div
  class="modal fade"
  id="staticBackdrop"
  data-mdb-backdrop="static"
  data-mdb-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modalTitle">
        <h5 class="modal-title modalh5" id="staticBackdropLabel" style="margin-right:400px;">Login</h5>
        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    
      <form action="{{route('login')}}" method="POST">
      @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="login_email" aria-describedby="emailHelp" name="login_email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="login_password" name="login_password">
          </div>
          <div class="modal-footer">
          <div class="login_errMsg"></div>
          <button type="button" class="btn" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" data-mdb-ripple-init id="loginbtn">Login</button>
          </div>
    </form>

      </div>
      
    </div>
  </div>
</div>



<!-- Modal Registration-->
<div
  class="modal fade"
  id="staticBackdropreg"
  data-mdb-backdrop="static"
  data-mdb-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel" style="margin-right:350px;">Registration</h5>
        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    
      <form action="{{route('registration')}}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="uname" class="form-label">Username</label>
            <input type="text" class="form-control" id="uname" aria-describedby="emailHelp" name="uname">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"> 
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
          </div>
          <div class="modal-footer">
        <div class="register_errMsg"></div>
        <button type="button" class="btn" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" data-mdb-ripple-init id="registerbtn">Sign Up</button>
        </div>
    </form>

      </div>
      
    </div>
  </div>
</div>

<script>

  const registername = document.querySelector('#uname');
  const registeremail = document.querySelector('#email');
  const registerpwd = document.querySelector('#password');
  const confirm_registerpwd = document.querySelector('#confirm_password');
  const registerbtn = document.querySelector('#registerbtn');
  const register_errMsg = document.querySelector('.register_errMsg');
  const registername_reg = /^[a-zA-Z0-9-_]{6,12}$/;
  const registeremail_reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  const registerpwd_reg = /^[a-zA-Z0-9-?]{6,20}$/;

  const loginemail = document.querySelector('#login_email');
  const loginepwd = document.querySelector('#login_password');
  const loginbtn = document.querySelector('#loginbtn');
  const login_errMsg = document.querySelector('.login_errMsg');

 
  const header_login = document.querySelector('#header_login');
  const header_registraion = document.querySelector('#header_registraion');
  const my_reservation = document.createElement('div');
  const header = document.querySelector('.header');
  my_reservation.innerHTML = `<a class="btn btn-link px-3 me-2" href="{{route('my_reservation')}}">My Reservation</a>`;


  const logout = document.createElement('button');
  logout.className = 'btn btn-primary me-3';
  logout.href = '#';
  logout.style.display = 'none';

  


  registername.addEventListener('click', ()=> {
    register_errMsg.style.display = 'none';
  });

  registeremail.addEventListener('click', ()=> {
    register_errMsg.style.display = 'none';
  });

  registerpwd.addEventListener('click', ()=> {
    register_errMsg.style.display = 'none';
  });

  confirm_registerpwd.addEventListener('click', ()=> {
    register_errMsg.style.display = 'none';
  });


  registerbtn.addEventListener('click', (e) => {
    

    if(!registername_reg.test(registername.value)){

        e.preventDefault();
        register_errMsg.style.display = 'block';
        register_errMsg.innerHTML = 'Username must be 6-12 characters only contain letters numbers or _';

    } else if(!registeremail_reg.test(registeremail.value)){

        e.preventDefault();
        register_errMsg.style.display = 'block';
        register_errMsg.innerHTML = 'Please input a valid email';

    } else if(!registerpwd_reg.test(registerpwd.value)){

        e.preventDefault();
        register_errMsg.style.display = 'block';
        register_errMsg.innerHTML = 'must be 6-20 characters';

    } else if(registerpwd.value !== confirm_registerpwd.value){
        
        e.preventDefault();
        register_errMsg.style.display = 'block';
        register_errMsg.innerHTML = 'Passwords must be the same';
    
    } 
  });

  
  
  loginemail.addEventListener('click', ()=> {
    login_errMsg.style.display = 'none';
  });

  loginepwd.addEventListener('click', ()=> {
    login_errMsg.style.display = 'none';
  });

  loginbtn.addEventListener('click', (e) => {
    
    if(loginemail.value === "" || loginepwd.value === ""){

      e.preventDefault();
      login_errMsg.style.display = 'block';
      login_errMsg.innerHTML = 'Input cannot be empty!';

      }
    

  });


  let session_uname = "{{ session('user_name') }}";
  let session_email = "{{ session('user_email') }}";

  sessionStorage.setItem('user_email', session_email);
 
  

  if(session_uname){

    header_login.style.display = 'none';
    header_registraion.style.display = 'none';

    header.appendChild(my_reservation);
    my_reservation.style.display = 'block';

    logout.innerHTML = `Logout`;
    header.appendChild(logout);
    logout.style.display = 'block';
  

  }

  logout.addEventListener('click', () => {
    sessionStorage.clear();

    fetch('http://localhost/assignments/hotel_reservation/public/logout', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
        'Content-Type': 'application/json'
    }
})
.then(response => {
    if (response.ok) {
        header_login.style.display = 'block';
        header_registraion.style.display = 'block';
        logout.style.display = 'none';
        my_reservation.style.display= 'none';
        window.location.href = "http://localhost/assignments/hotel_reservation/public/index";
    } else {
        console.log("logout not successful");
    }
})
.catch(error => {
    console.error('Error:', error);
});
    
});
  

  
  
</script>