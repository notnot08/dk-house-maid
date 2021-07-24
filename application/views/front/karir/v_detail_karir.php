  <!-- bradcam_area  -->
  <div class="bradcam_area breadcam_bg_3">
   <div class="container">
     <div class="row">
         <div class="col-xl-12">
             <div class="bradcam_text">
                 <!-- <h3>single blog</h3> -->
             </div>
         </div>
     </div>
   </div>
 </div>
 <!-- /bradcam_area  -->

   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 posts-list">
               <?php foreach($det_karir->result() as $row ): ?>
               <div class="single-post">
                  <div class="blog_details">
                     <h2><?php echo $row->JUDUL; ?>
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i> <?php echo $row->USER; ?></a></li>
                        <li><a href="#"><i class="fa fa-comments"></i> <?php echo $row->INSERT_DATE; ?></a></li>
                     </ul>
                     <p class="excert">
                        <?php echo $row->DESKRIPSI; ?>
                     </p>
                  </div>
               </div>
               <?php endforeach; ?>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->