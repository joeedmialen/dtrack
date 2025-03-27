<?= $this->extend('layout_default'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Search</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Search</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content m-0 p-0">

    <div class="card container-md mobile-fixed-full">
        <div class="card-header mobile-sticky-header px-1">
            <a class="btn btn-default rounded-circle" href="<?= base_url('') ?>"><i class="fas fa-arrow-left"></i> </a>
            <!-- Search -->
        </div>
        <div class="card-body">
            <h2 class="text-center display-4">Search</h2>
            <div class="row px-1">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <input id="searchQuery" type="search" class="form-control form-control-lg" placeholder="Search document by name or by tracking code">
                        <div class="input-group-append">
                            <button id="searchBtn" type="" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 ">
                <div id="searchResults" class="container text-center">

                </div>

            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>

<script>


    $(document).ready(function() {
        $('#searchBtn').click(function() {

            var target = document.getElementById('searchResults');
            $('#searchResults').empty(); // Clear previous result


            var query = String($('#searchQuery').val()).trim();
            if (String(query).length <= 2) {
                Swal.fire(
                    'Error',
                    'Search keyword must have atleast 3 characters.',
                    'error'
                )
            } else {
                var spinner = new Spinner('searchResults', 'Searching...');
                setTimeout(function() {

                    $.ajax({
                        url: '<?= base_url('search/results') ?>',
                        type: 'post',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            $('#searchResults').html(response);
                            // Swal.hideLoading();
                            // Swal.close();
                            function highlight(string, keyword) {
                                var stringWithKeywords = String(string);
                                var pattern = keyword;
                                var regex = new RegExp(pattern, "i");
                                var highlighted = stringWithKeywords.replace(regex, '<span class="bg-warning">' + keyword + '</span>', );
                                return highlighted;
                            }

                            var higlightables = document.querySelectorAll('.higlightable');
                            higlightables.forEach((item) => {
                                var itemTextContent = item.textContent;
                                var hilightedTextContent = highlight(itemTextContent, query);
                                item.innerHTML = hilightedTextContent;
                            });




                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching search results:', error);
                            spinner.destroy();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                background: '#ffa851',
                                color: '#1e1e1e',
                                timer: '5000',
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })

                            $('#searchResults').html('<i class="text-danger">' + error + '</i>');


                        }
                    });


                }, 2000);
            }


        });
    });
</script>
<!-- /.content -->

<?= $this->endSection(); ?>