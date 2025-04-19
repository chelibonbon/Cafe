<!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="text-body mb-2 mb-md-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by
                    <a href="https://themeselection.com" target="_blank" class="footer-link">ThemeSelection</a>
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                    <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                    <a
                      href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/"
                      target="_blank"
                      class="footer-link me-4"
                      >Documentation</a
                    >

                    <a
                      href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free/issues"
                      target="_blank"
                      class="footer-link"
                      >Support</a
                    >
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    >
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?=base_url('assets/vendor/libs/jquery/jquery.js')?>"></script>
    <script src="<?=base_url('assets/vendor/libs/popper/popper.js')?>"></script>
    <script src="<?=base_url('assets/vendor/js/bootstrap.js')?>"></script>
    <script src="<?=base_url('assets/vendor/libs/node-waves/node-waves.js')?>"></script>
    <script src="<?=base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')?>"></script>
    <script src="<?=base_url('assets/vendor/js/menu.js')?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?=base_url('assets/js/main.js')?>"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
     <script>
    let timeout = 900000 ; // 900000 is 20 minutes in milliseconds  1 minute is 60000
    let timer;

    function resetTimer() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            window.location.href = "<?= base_url('home/login') ?>"; // Redirect to login on timeout
        }, timeout);
    }

    // ✅ Reset timer on user activity
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer;
    window.ontouchstart = resetTimer;
    window.ontouchmove = resetTimer;
    window.onclick = resetTimer;
    window.onkeydown = resetTimer;
</script>
  </body>
</html>
