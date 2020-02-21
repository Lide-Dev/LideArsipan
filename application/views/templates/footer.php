<?php if (!empty($footerext)&&$footerext===true){ ?>
   <!-- Footer -->
   <footer class="page-footer font-small bg-blackpearl pt-4">

     <!-- Footer Links -->
     <div class="container text-center text-md-left">

       <!-- Footer links -->
       <div class="row text-center text-md-left mt-3 pb-3">

         <!-- Grid column -->
         <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-londonsquare">
           <h6 class="text-uppercase mb-4 font-weight-bold">PEMERINTAH DESA CONDONGCATUR</h6>
           <p>Pemerintah Desa Condongcatur berdiri pada tanggal 26 Desember 1946 berdasarkan Maklumat Pemerintah Daerah Istimewa Yogyakarta Nomor 5 Tahun 1948.</p>
         </div>
         <!-- Grid column -->

         <hr class="w-100 clearfix d-md-none">

         <!-- Grid column -->
         <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 text-londonsquare">
           <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
           <p>
             <a href="#!">LideDev</a>
           </p>
         </div>

         <!-- Grid column -->
         <hr class="w-100 clearfix d-md-none">

         <!-- Grid column -->
         <div class="col-md-4 col-lg-3 col-xl-7 mx-auto mt-3 text-londonsquare">
           <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
           <p>
             <i class="fas fa-home mr-3"></i> Depok, Sleman, Yogyakarta, 55583</p>
           <p>
             <i class="fas fa-envelope mr-3"></i> condongcatur1946@gmail.com</p>
           <p>
             <i class="fas fa-print mr-3"></i> (0274) 885 689</p>
           <p class="float-right"><a href="#">Back to top</a></p>
         </div>

         <!-- Grid column -->

       </div>
       <!-- Footer links -->

       <hr>

       <!-- Grid row -->
       <div class="row d-flex align-items-center">

         <!-- Grid column -->
         <div class="col-md-7 col-lg-8">

           <!--Copyright-->
           <p class="text-center text-md-left text-white">© 2020 Copyright:
             <a href="#">
               <strong> LideDev</strong>
             </a>
           </p>

         </div>
         <!-- Grid column -->

         <!-- Grid column -->
         <div class="col-md-5 col-lg-4 ml-lg-0">

           <!-- Social buttons -->
           <div class="text-center text-md-right">
             <ul class="list-unstyled list-inline">
               <li class="list-inline-item">
                 <a class="btn-floating btn-sm rgba-white-slight mx-1">
                   <i class="fab fa-facebook-f"></i>
                 </a>
               </li>
               <li class="list-inline-item">
                 <a class="btn-floating btn-sm rgba-white-slight mx-1">
                   <i class="fab fa-twitter"></i>
                 </a>
               </li>
               <li class="list-inline-item">
                 <a class="btn-floating btn-sm rgba-white-slight mx-1">
                   <i class="fab fa-google-plus-g"></i>
                 </a>
               </li>
               <li class="list-inline-item">
                 <a class="btn-floating btn-sm rgba-white-slight mx-1">
                   <i class="fab fa-linkedin-in"></i>
                 </a>
               </li>
             </ul>
           </div>

         </div>
         <!-- Grid column -->

       </div>
       <!-- Grid row -->

     </div>
     <!-- Footer Links -->

   </footer>
   <!-- Footer -->
<?php }?>

   </body>
   <script src=<?= base_url('assets/js/jquery.js') ?>></script>
   <script src=<?= base_url('assets/js/jquery-ui.min.js') ?>></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sp-1.0.1/sl-1.3.1/datatables.min.js"></script>
   <script src=<?= base_url('assets/js/sidebar.js') ?>></script>
   <script src=<?= base_url('assets/js/fontawesome.js') ?>></script>
   <script src=<?= base_url('assets/js/bootstrap.bundle.min.js') ?>></script>
   <script src=<?= base_url('assets/js/fontawesome.min.js') ?>></script>
   <script type="text/javascript">
     $('[data-toggle="tooltip"]').tooltip()
   </script>

   <?php
    if ($page === "form_surat") {
    ?>
     <script src=<?= base_url('assets/js/page/form_surat.js') ?>></script>
   <?php
    }
    if ($page === "arsip") {
    ?>
     <script type="text/javascript" src=<?= base_url('assets/js/page/arsip.js') ?>></script>
   <?php
    } if ($page === "login"){
      echo "<script src=".base_url('assets/js/bug_report.js')."></script>";
      echo "<script src=".base_url('assets/js/page/login.js')."></script>";
    }
    ?>

   </html>