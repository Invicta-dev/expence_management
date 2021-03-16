<?= $this->include('includes/header') ?>
<?= $this->include('includes/sidebar') ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Process</a>
                </li>
            </ul>
            <!-- <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="#">
                                            <i class="icon-bell"></i> Action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-shield"></i> Another action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-user"></i> Something else here</a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-bag"></i> Separated link</a>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Process
            <!-- <small>blank page layout</small> -->
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <!-- <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-user"></i>
                                        <span class="caption-subject font-red sbold uppercase">Users</span>
                                    </div>
                                </div> -->
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <!-- <div class="col-md-6">
                                                <div class="btn-group">
                                                    <button id="sample_editable_1_new" class="btn green"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div> -->
                                <div class="col-md-4">

                                    <?= form_open(base_url() . '/add_process', 'autocomplete="off"') ?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="process" placeholder="Add new process">
                                        <span class="input-group-btn">
                                            <!-- <button class="btn blue" type="button">Add New</button> -->
                                            <input type="submit" class="btn blue" value="Add New">
                                        </span>

                                    </div>
                                    <?php if (session()->has('validation')) {
                                        echo "<p style='color:red;'>" . session()->getFlashdata('validation')->getError('process') . "</p>";
                                    } ?>
                                    <!-- /input-group -->
                                    <?= form_close(); ?>
                                </div>
                                <!-- <div class="col-md-6">
                                                <div class="btn-group pull-right">
                                                    <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;"> Print </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;"> Save as PDF </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;"> Export to Excel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div> -->
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>

                                    <th> Process Name </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($processes as $process) : ?>
                                    <tr>
                                        <td><?= $process['process_name'] ?> </td>
                                        <td>
                                            <a onclick="delete_process(<?= $process['id'] ?>)"> Delete </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url(); ?>/assets/pages/js/table-datatables-editable.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    function delete_process(prd_code) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data from database
            $.ajax({
                url: "<?= base_url(); ?>/deleteProcess/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        swal("Sorry!", "<?= session()->getFlashdata("error") ?>", "error");
    </script>
<?php elseif (session()->getFlashdata('success')) : ?>
    <script>
        swal("success!", "<?= session()->getFlashdata("success") ?>", "success");
    </script>

<?php endif; ?>
<?= $this->include('includes/footer') ?>