
<section id="slider-banner" class="swiper_wrapper page-link-inner clearfix"
         style="height: 400px !important; margin-bottom: -200px;">
    <div class="slider">
        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide-page dark" style="background-image: url('/img/header-pages2.png');">
                    <div class="container clearfix">
                        <div class="container clearfix">
                            <div class="heading-block text-right dark plh">
                                <?php if(isset($pageTitle) && strlen($pageTitle)>0){ ?>
                                <h2><?php echo $pageTitle;?></h2>
                                <?php }else{ ?>
                                <h2> Voice of Mankind</h2>
                                <span>We Speak behalf of Low &amp; on behalf of mankind</span>
                                <?php } ?>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sidbar menu -->
<script type="text/javascript">
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.body.style.backgroundColor = "white";
    }
</script>
