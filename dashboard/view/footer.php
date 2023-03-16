         </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="../js/sydeestack.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js" ></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script type="importmap">
            {
                "imports": {
                "vue": "https://unpkg.com/vue@3/dist/vue.esm-browser.js"
                }
            }
            </script>
  
    <?php 
    
        if (isset($_GET['p'])) {
            $p = $_GET['p'];
        
           if($_GET['p'] === 'bids'){
            echo "<script src='js/$p.js?v=78' type='module'></script>";
           }else{
            echo "<script src='js/$p.js'></script>";

           }
        }
    ?>
    
</body>

</html>