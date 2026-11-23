@php
    $modalForm = old('_modal') ?? session('open_modal');
    $modalForm = in_array($modalForm, ['login', 'register'], true) ? $modalForm : null;
@endphp
<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Sign In & Sign Up
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <section>
        <div class="modal-body">
          <div class="w3_login_module">
            <div class="module form-module">
              <div class="toggle"><i class="fa fa-times fa-pencil"></i>
                <div class="tooltip">Click Me</div>
              </div>

              <div class="form">
                <h3>Login to your account</h3>
                @if ($modalForm === 'login' && $errors->any())
                  <div style="color:#d9534f; font-size:13px; margin-bottom:10px;">
                    @foreach ($errors->all() as $error)
                      <div>{{ $error }}</div>
                    @endforeach
                  </div>
                @endif
                <form action="{{ route('login.store') }}" method="post">
                  @csrf
                  <input type="hidden" name="_modal" value="login">
                  <input type="email" name="email" placeholder="Email"
                         value="{{ $modalForm === 'login' ? old('email') : '' }}" required>
                  <input type="password" name="password" placeholder="Password" required>
                  <input type="submit" value="Login">
                </form>
              </div>

              <div class="form">
                <h3>Create an account</h3>
                @if ($modalForm === 'register' && $errors->any())
                  <div style="color:#d9534f; font-size:13px; margin-bottom:10px;">
                    @foreach ($errors->all() as $error)
                      <div>{{ $error }}</div>
                    @endforeach
                  </div>
                @endif
                <form action="{{ route('register.store') }}" method="post">
                  @csrf
                  <input type="hidden" name="_modal" value="register">
                  <input type="text" name="name" placeholder="Name"
                         value="{{ $modalForm === 'register' ? old('name') : '' }}" required>
                  <input type="email" name="email" placeholder="Email Address"
                         value="{{ $modalForm === 'register' ? old('email') : '' }}" required>
                  <input type="password" name="password" placeholder="Password (min. 8 characters)" required>
                  <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                  <input type="submit" value="Register">
                </form>
              </div>

              <div class="cta"><a href="#">Forgot your password?</a></div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script>
  $('.toggle').click(function(){
    // Switches the Icon
    $(this).children('i').toggleClass('fa-pencil');
    // Switches the forms
    $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
    }, "slow");
  });

  // Buka popup, lalu pilih tab login atau register
  function openAuthModal(which) {
    $('#myModal').modal('show');
    var isRegister = !$('.toggle i').hasClass('fa-pencil');
    if ((which === 'register') !== isRegister) {
      $('.toggle').trigger('click');
    }
  }
</script>
@if ($modalForm)
<script>
  $(function () { openAuthModal('{{ $modalForm }}'); });
</script>
@endif