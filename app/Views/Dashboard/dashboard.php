<?= $this->include('includes/header'); ?>
<link href="<?= base_url(); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<?= $this->include('includes/sidebar'); ?>
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
                    <a href="#">Dashboard</a>
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
        <h3 class="page-title"> Dashboard
            <!-- <small>blank page layout</small> -->
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row widget-row">
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered" style="padding: 15px;">
                    <h4 class="widget-thumb-heading">Daily Expensess</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-clock"></i>
                        <div class="widget-thumb-body">
                            <!-- <span class="widget-thumb-subtitle">USD</span> -->
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= isset($day_expense_count) ? $day_expense_count : 0 ?>">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered" style="padding: 15px;">
                    <h4 class="widget-thumb-heading">Weekly Expenses</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red icon-layers"></i>
                        <div class="widget-thumb-body">
                            <!-- <span class="widget-thumb-subtitle">USD</span> -->
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= isset($weekly_expense) ? $weekly_expense : 0 ?>">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered" style="padding: 15px;">
                    <h4 class="widget-thumb-heading">Average Monthly Expenses</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple icon-pie-chart"></i>
                        <div class="widget-thumb-body">
                            <!-- <span class="widget-thumb-subtitle">USD</span> -->
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= isset($month_expense_count) ? $month_expense_count : 0 ?>">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered" style="padding: 15px;">
                    <h4 class="widget-thumb-heading">Total Expenses</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                        <div class="widget-thumb-body">
                            <!-- <span class="widget-thumb-subtitle">USD</span> -->
                            <?php
                            if (session()->has('Filterdata')) {
                                $arr = session()->getFlashData('Filterdata');
                                $removed = array_pop($arr); ?>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= ($removed['amount'] != '') ? $removed['amount'] : 0 ?>">0</span>

                            <?php } else { ?>
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?= isset($total_expense_count) ? $total_expense_count : 0 ?>">0</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="btn-group">
                                        <!-- <button id="#" class="btn green"> Add New -->
                                        <a href="<?= base_url() ?>/expense" class="btn green">Add New
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2 pull-right">
                                    <div class="btn-group pull-right">
                                        <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" id="sample_3_tools">
                                            <li>
                                                <a href="javascript:;" data-action="0" class="tool-action">
                                                    <i class="icon-printer"></i> Print</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-action="1" class="tool-action">
                                                    <i class="icon-check"></i> Copy</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-action="2" class="tool-action">
                                                    <i class="icon-doc"></i> PDF</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-action="3" class="tool-action">
                                                    <i class="icon-paper-clip"></i> Excel</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-action="4" class="tool-action">
                                                    <i class="icon-cloud-upload"></i> CSV</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-table">
                            <?= form_open(base_url() . '/filter') ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Process</label>
                                    <select class="form-control input-small" name="process" data-placeholder="Choose a Process" tabindex="1">
                                        <option disabled selected>---select---</option>
                                        <?php if (isset($processes)) :
                                            foreach ($processes as $process) : ?>
                                                <option value="<?= $process['process_name'] ?>"><?= $process['process_name'] ?></option>
                                        <?php endforeach;
                                        endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <select class="form-control input-small" name="category" data-placeholder="Choose a Category" tabindex="1">
                                        <option disabled selected>---select---</option>
                                        <?php if (isset($categories)) :
                                            foreach ($categories as $category) : ?>
                                                <option value="<?= $category['category_name'] ?>"><?= $category['category_name'] ?></option>
                                        <?php endforeach;
                                        endif; ?>
                                    </select>
                                </div>
                            </div>
                            <?php if (isset($users)) : ?>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">User</label>
                                        <select class="form-control input-small" name="user" data-placeholder="Choose a Category" tabindex="1">
                                            <option disabled selected>---select---</option>

                                            <?php foreach ($users as $user) : ?>

                                                <option value="<?= $user['username'] ?>"><?= $user['username'] ?></option>
                                            <?php endforeach; ?>

                                        </select>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-6" style="position: relative; bottom: 1rem;">
                                <span class="help-block"> Select date range to search </span>
                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd" style="display:inline-flex;">
                                    <input type="text" class="form-control" name="from" autocomplete="off">
                                    <span class="input-group-addon" style="line-height:unset; padding-right:20px"> to &nbsp;</span>
                                    <input type="text" class="form-control" name="to" autocomplete="off"> &nbsp;
                                    <button type="submit" id="#" class="btn green"><i class="fa fa-search"></i> Search </button>

                                </div>
                                <!-- /input-group -->

                            </div>
                            <?= form_close(); ?>
                        </div>

                        <table class="table table-striped table-hover table-bordered" id="dashboard_editable">
                            <thead>
                                <tr>
                                    <th class="hidden-lg hidden-md hidden-xs">ID</th>
                                    <th> User </th>
                                    <th> Vendor </th>
                                    <th> Process </th>
                                    <th> Category </th>
                                    <th> Currency </th>
                                    <th> Payment type</th>
                                    <th> Amount </th>
                                    <th> Bill details </th>
                                    <th> Created date </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (session()->has('Filterdata')) :
                                    $arr = session()->getFlashData('Filterdata');
                                    $removed = array_pop($arr); //to remove sum of total amount from array
                                    foreach ($arr as $tb_data) :
                                ?>
                                        <tr>
                                            <td class="hidden-lg hidden-md hidden-xs"><?= $tb_data['expense_id'] ?></td>
                                            <td class="center">
                                                <?= $tb_data['user'] ?>
                                            </td>
                                            <td><a class="view-order" data-toggle="modal" href="#view-order-modal"><?= $tb_data['expense'] ?></a></td>
                                            <td><?= $tb_data['process'] ?> </td>
                                            <td> <?= $tb_data['category'] ?> </td>
                                            <td><?= $tb_data['currency'] ?></td>
                                            <td> <?= $tb_data['payment_mode'] ?> </td>
                                            <td> <?= $tb_data['amount'] ?> </td>
                                            <?php if (session()->has('billImage')) : ?>
                                                <td>
                                                    <?php
                                                    $expense_img = session()->getFlashData('billImage');
                                                    foreach ($expense_img as $image) :
                                                        if ($image['expense_img_id'] == $tb_data['expense_id']) : ?>

                                                            <a href="<?= base_url() ?>/assets/pages/upload/<?= $image['bill_img'] ?>" target="_blank"><?= $image['bill_img']; ?></a><br>
                                                    <?php endif;
                                                    endforeach; ?>
                                                </td>
                                            <?php endif; ?>
                                            <!-- <td>Imagefilename</td> -->
                                            <td><?= $tb_data['created_on'] ?> </td>
                                            <td>
                                                <a class="edit" href="javascript:;"> Edit </a>
                                                <a onclick="delete_expense(<?= $tb_data['expense_id'] ?>)"> Delete </a>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                else :
                                    foreach ($expense as $tb_data) : ?>
                                        <tr>

                                            <td class="hidden-lg hidden-md hidden-xs"><?= $tb_data['expense_id'] ?></td>
                                            <td class="center">
                                                <?= $tb_data['user'] ?>
                                            </td>
                                            <td><a class="view-order" data-toggle="modal" id="<?= $tb_data['expense_id'] ?>" href="#view-order-modal"><?= $tb_data['expense'] ?></a></td>
                                            <td><?= $tb_data['process'] ?> </td>
                                            <td> <?= $tb_data['category'] ?> </td>
                                            <td><?= $tb_data['currency'] ?></td>
                                            <td> <?= $tb_data['payment_mode'] ?> </td>
                                            <td> <?= $tb_data['amount'] ?> </td>
                                            <?php if (isset($expense_img)) : ?>
                                                <td>
                                                    <?php foreach ($expense_img as $image) :
                                                        if ($image['expense_img_id'] == $tb_data['expense_id']) : ?>

                                                            <a href="<?= base_url() ?>/assets/pages/upload/<?= $image['bill_img'] ?>" target="_blank" multiple><?= $image['bill_img']; ?></a><br>
                                                    <?php endif;
                                                    endforeach; ?>
                                                </td>
                                            <?php endif; ?>

                                            <!-- <td>Imagefilename</td> -->
                                            <td><?= $tb_data['created_on'] ?> </td>
                                            <td>
                                                <a class="edit" href="javascript:;"> Edit </a>
                                                <a onclick="delete_expense(<?= $tb_data['expense_id'] ?>)"> Delete </a>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- ITEM MODEL -->
        <div id="view-order-modal" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">ITEMS</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="#" method="post" accept-charset="utf-8" class="form-horizontal">
                                <fieldset>
                                    <div class="form-group">
                                        <!-- <div class="col-md-12 "><label>Purchase Details:</label></div> -->
                                        <div class="items-result">
                                        </div>

                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF ITEM MODEL -->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<?= $this->include('includes/footer'); ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    function delete_expense(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data from database
            $.ajax({
                url: "<?= base_url(); ?>/deleteExpense/" + id,
                type: "POST",
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


    function edit_expense() {
        // submit button click

        var unique = $("#unique").val();
        var category = $("#category").val();
        var process = $("#process").val();
        var amount = $("#amount").val();
        var img = $("#img").val();
        var expense = $('#expense').val();
        var currency = $('#currency').val();
        var payment_mode = $('#payment_mode').val();
        var fd = new FormData();
        var files = $("#img").get(0).files; // this is my file input in which We can select multiple files.
        fd.append("unid", unique);
        fd.append('category', category);
        fd.append('process', process);
        fd.append('amount', amount);
        fd.append('expense', expense);
        fd.append('currency', currency);
        fd.append('payment_mode', payment_mode);

        for (var i = 0; i < files.length; i++) {
            fd.append("UploadedImage" + i, files[i]);
        }



        // EDIT EXPENSE
        $.ajax({
            url: "<?= base_url(); ?>/edit-expense",
            type: "POST",
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error editing data');
            }
        });


    }
    //ITEM MODEL DATA AS PER THE ID PASSED
    $(document).on('click', '.view-order', function() {


        var item_id = $(this).attr('id');
        // console.log(item_id);
        $.ajax({
            url: "<?= base_url(); ?>/item-details",
            type: "Post",
            data: {
                item_id: item_id
            },
            success: function(data) {

                $('.items-result').html(data); // get item details in table view
            }

        });

    });
</script>
</script>
<!-- <script src="./assets/pages/js/table-datatables-editable.min.js" type="text/javascript"></script> -->
<script src="<?= base_url(); ?>/assets/pages/js/table-datatables-editable.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/pages/js/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!-- <script src="./assets/pages/js/table-datatables-buttons.min.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL SCRIPTS -->