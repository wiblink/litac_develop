		<footer class="footer footer-transparent d-print-none">
          <div class="container">
            <div class="row text-center align-items-center flex-row-reverse">
              
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    <strong>Version</strong> <?php echo ver();?> <?php $configx = explode("#", configx()); if($configx[3] !=''){echo $configx[3].' | ';}?> Copyright &copy; <?php echo date('Y');?>
                    <!--<a href="." class="link-secondary">Tabler</a>.-->
                    All rights reserved.
                  </li>
                  <li class="list-inline-item">
                    <a href="./changelog.html" class="link-secondary" rel="noopener"><?php echo ver();?></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
    </div>
</div>
	<!-- Libs JS -->
    <script src="<?php echo base_url();?>assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <!-- Tabler Core -->
    <script src="<?php echo base_url();?>assets/js/tabler.min.js"></script>
  </body>
</html>