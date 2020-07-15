 <!-- form itself end-->
 <div id="test-form" class="white-popup-block mfp-hide">
     <div class="popup_box">
         <div class="popup_inner">
             <div class="logo text-center">
                 <a href="#">
                     <img src="img/form-logo.png" alt="">
                 </a>
             </div>
             <h3>Đăng Nhập</h3>
             <form action="{{route('user.post')}}" method="POST">
                 @csrf
                 <div class="row">
                     <div class="col-xl-12 col-md-12">
                         <input type="email" name="email" placeholder="Enter email">
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="password" name="password" placeholder="Password">
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
                     <button type="submit" class="boxed_btn_orange">Đăng nhập Google</button>
                 </div>
                 <div class="col-xl-12 col-md-12">
                     <button type="submit" class="boxed_btn_orange">Đăng nhập Facebook</button>
                 </div>
             </div>

             <p class="doen_have_acc">Bạn chưa có tài khoản? <a class="dont-hav-acc" href="#test-form2">Đăng ký</a>
             </p>
         </div>
     </div>
 </div>
 <!-- form itself end -->

 <!-- form itself end-->
 <div id="test-form2" class="white-popup-block mfp-hide">
     <div class="popup_box">
         <div class="popup_inner">
             <div class="logo text-center">
                 <a href="#">
                     <img src="img/form-logo.png" alt="">
                 </a>
             </div>
             <h3>Đăng Ký</h3>
             <form action="{{route('user.post')}}" method="POST">
                 @csrf
                 <div class="row">
                     <div class="col-xl-12 col-md-12">
                         <input type="text" name="name" class="form-control" placeholder="Nhập tên">
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="email" name="email" class="form-control" placeholder="Email">
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="password" name="password" placeholder="Mật khẩu">
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="password" name="password_confirmation" placeholder="Xác nhận mất khẩu">
                     </div>
                     <div class="col-xl-12 col-md-12">
                         <input type="text" name="student_code" class="form-control" placeholder="Mã sinh viên">
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