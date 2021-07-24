    <!-- slider_area_start -->
    <div class="slider_area">
      <div class="single_slider  d-flex align-items-center slider_bg_1 overlay">
        <div class="container">
          <div class="row align-items-center justify-content-start">
            <div class="col-lg-10 col-md-10">
              <div class="slider_text">
                <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
                  HOUSEMAID
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- slider_area_end -->

    <!-- service_area  -->
    <div class="service_area">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section_title text-center mb-70">
              <!-- <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" >Services</span> -->
              <h3 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">HOUSEMAID</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <?php foreach($about_us_detail->result() as $row ): ?>
          <div class="col-xl-4 col-md-4">
            <div class="single_service text-center wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay=".4s">
              <div class="icon">
                <img src="<?php echo base_url();?>assets/frontend/img/svg_icon/1.svg" alt="">
              </div>
              <h3><?php echo $row->TITLE; ?></h3>
              <p><?php echo $row->CONTENT; ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!--/ service_area  -->

    <div class="about_area">
      <div class="container">
        <div class="row justify-content-end">
          <div class="col-lg-5 offset-lg-1">
            <div class="about_info">
              <div class="section_title white_text">
                <span class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">About Us</span>
                <?php foreach($about_us->result() as $row ): ?>
                  <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s"><?php echo $row->TITLE;?></h3>
                  <p class="mid_text wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s"><?php echo $row->CONTENT;?></p>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- portfolio_image_area  -->
    <div class="portfolio_image_area">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-12">
            <div class="single_Portfolio wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
              <div class="portfolio_thumb">
                <img src="<?php echo base_url();?>assets/frontend/img/content/photo3.jpg" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="single_Portfolio wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
              <div class="portfolio_thumb">
                <img src="<?php echo base_url();?>assets/frontend/img/content/photo6.jpg" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-lg-4">
            <div class="single_Portfolio wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
              <div class="portfolio_thumb">
                <img src="<?php echo base_url();?>assets/frontend/img/content/photo5.jpg" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-lg-4">
            <div class="single_Portfolio wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
              <div class="portfolio_thumb">
                <img src="<?php echo base_url();?>assets/frontend/img/content/photo7.jpg" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-lg-4">
            <div class="single_Portfolio wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
              <div class="portfolio_thumb">
                <img src="<?php echo base_url();?>assets/frontend/img/content/photo8.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ portfolio_image_area  -->

    <!-- team_member_start -->
    <div class="team_area ">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section_title text-center mb-90">
              <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">Our Teams</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="single_team wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
              <div class="team_thumb">
                <img src="<?php echo base_url();?>assets/frontend/img/team/1.png" alt="">
              </div>
              <div class="team_title text-center">
                <h3>DEVI INDRIANI SETYATMAJI</h3>
                <p>41817310013</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="single_team wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
              <div class="team_thumb">
                <img src="<?php echo base_url();?>assets/frontend/img/team/2.png" alt="">
              </div>
              <div class="team_title text-center">
                <h3>ASYIFA HERSUMULYOASTUTI</h3>
                <p>41817310020</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="single_team wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
              <div class="team_thumb">
                <img src="<?php echo base_url();?>assets/frontend/img/team/3.png" alt="">
              </div>
              <div class="team_title text-center">
                <h3>IMAM FADILLAH</h3>
                <p>41817310012</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ team_member_end -->