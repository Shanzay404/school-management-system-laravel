<script src="/Admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/Admin/assets/js/bootstrap.bundle.min.js"></script>

<script src="/Admin/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="/Admin/assets/js/pages/dashboard.js"></script>

<script src="/Admin/assets/vendors/simple-datatables/simple-datatables.js"></script>

<script src="/Admin/assets/vendors/jquery/jquery.min.js"></script>
<script src="/Admin/assets/vendors/summernote/summernote-lite.min.js"></script>
    <script>
          $('#summernote').summernote({
        tabsize: 2,
        height: 120,
    })
    $("#hint").summernote({
        height: 100,
        toolbar: false,
        placeholder: 'type with apple, orange, watermelon and lemon',
        hint: {
            words: ['apple', 'orange', 'watermelon', 'lemon'],
            match: /\b(\w{1,})$/,
            search: function (keyword, callback) {
                callback($.grep(this.words, function (item) {
                    return item.indexOf(keyword) === 0;
                }));
            }
        }
    });

        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

       
    </script>
    
<script src="/Admin/assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
<script src="/Admin/assets/vendors/choices.js/choices.min.js"></script>
<script src="/Admin/assets/js/main.js"></script>


