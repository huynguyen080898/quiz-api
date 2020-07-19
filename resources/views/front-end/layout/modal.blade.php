 <!-- form itself end-->

 <div id="test-form" class="white-popup-block mfp-hide">
     @include('notifications.messages')
     <div class="popup_box">
         <div class="popup_inner">
             <div class="logo text-center">
                 <a href="#">
                     <img src="img/newlogo.png" alt="">
                 </a>
             </div>
             <h3>Đăng Nhập</h3>
             <form action="{{route('user.post')}}" method="POST">
                 @csrf
                 <div class="row">
                     <div class="col-xl-12 col-md-12">
                         <input type="email" name="email" placeholder="Enter email" required>
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="password" name="password" placeholder="Password" required>
                     </div>
                     <div class="col-xl-12">
                         <button type="submit" name="formSignIn" class="boxed_btn_orange">Đăng Nhập</button>
                     </div>
                 </div>
             </form>
             <div class="row  text-white">
                 <div class="col-xl-12 col-md-12 mt-4 text-center">Or</div>
             </div>

             <div class="row">
                 <div class="col-xl-12 col-md-12 my-4">
                     <a href="{{route('login.social','facebook')}}" class="fb btn bg-primary text-white">
                         <i class="fa fa-facebook fa-fw"></i> Đăng nhập bằng Facebook
                     </a>
                 </div>
                 <div class="col-xl-12 col-md-12">
                     <a href="{{route('login.social','google')}}" class="google btn bg-danger text-white"><i class="fa fa-google fa-fw">
                         </i> Đăng nhập bằng Google+
                     </a>
                 </div>
             </div>

             <p class="doen_have_acc">Bạn chưa có tài khoản? <a class="dont-hav-acc" href="#test-form2">Đăng ký</a> </p>
             <p class="doen_have_acc"> <a class="dont-hav-acc" href="#test-form3">Quên mật khẩu</a> </p>

         </div>
     </div>
 </div>
 <!-- form itself end -->

 <!-- form itself end-->
 <div id="test-form2" class="white-popup-block mfp-hide">
     @include('notifications.messages')
     <div class="popup_box">
         <div class="popup_inner">
             <div class="logo text-center">
                 <a href="#">
                     <img src="img/newlogo.png" alt="">
                 </a>
             </div>
             <h3>Đăng Ký</h3>
             <form action="{{route('user.post')}}" method="POST">
                 @csrf
                 <div class="row">
                     <div class="col-xl-12 col-md-12">
                         <input type="text" name="name" class="form-control" placeholder="Nhập tên" required>
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="password" name="password" placeholder="Mật khẩu" required>
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="password" name="password_confirmation" placeholder="Xác nhận mất khẩu" required>
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="text" name="student_code" class="form-control" placeholder="Mã sinh viên" required>
                     </div>
                     <div class="col-xl-12">
                         <button type="submit" name="formSignUp" class="boxed_btn_orange">Đăng Ký</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- form itself end -->


 <!-- form itself end-->
 <div id="test-form3" class="white-popup-block mfp-hide">
     @include('notifications.messages')
     <div class="popup_box">
         <div class="popup_inner">
             <div class="logo text-center">
                 <a href="#">
                     <img src="img/newlogo.png" alt="">
                 </a>
             </div>
             <h3>Quên mật khẩu</h3>
             <form action="{{route('user.post')}}" method="POST">
                 @csrf
                 <div class="row">
                     <div class="col-xl-12 col-md-12">
                         <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="col-xl-12">
                         <button type="submit" name="formSendMail" class="boxed_btn_orange">Gửi</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- form itself end -->