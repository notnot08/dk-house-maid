  <!-- bradcam_area  -->
  <div class="bradcam_area breadcam_bg_3">
    <div class="container">
      <div class="row">
          <div class="col-xl-12">
              <div class="bradcam_text">
                  <h3>pengumuman</h3>
              </div>
          </div>
      </div>
    </div>
  </div>
  <!-- /bradcam_area  -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <?php foreach($pengumuman->result() as $row ): ?>
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <a href="#" class="blog_item_date">
                                    <h3><?php echo $row->INSERT_DATE_DATE; ?></h3>
                                    <p><?php echo $row->INSERT_DATE_MONTH; ?></p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="<?php echo base_url('index.php/Front/pengumuman/detail/').$row->ID;?>">
                                    <h2><?php echo $row->JUDUL; ?></h2>
                                </a>
                                <p><?php echo $row->DESKRIPSI; ?></p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> <?php echo $row->USER; ?></a></li>
                                    <li><a href="#"><i class="fa fa-clock"></i> <?php echo $row->INSERT_DATE; ?></a></li>
                                </ul>
                            </div>
                        </article>
                        <?php endforeach; ?>

                        <!-- <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>
                            <?php foreach($sum_pengumuman->result() as $row ): ?>
                            <div class="media post_item">
                                <div class="media-body">
                                    <a href="<?php echo base_url('index.php/Front/pengumuman/detail/').$row->ID;?>">
                                        <h3><?php echo $row->JUDUL; ?></h3>
                                    </a>
                                    <p><?php echo $row->INSERT_DATE; ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->