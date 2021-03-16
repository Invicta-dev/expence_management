var TableDatatablesEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" id="unique" class="form-control input-small" value="' + aData[0] +'">';
            jqTds[1].innerHTML = '<input type="text" id="username" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" id="fullname" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" id="email" class="form-control input-small" value="' + aData[3] + '">';
            // jqTds[4].innerHTML = '<input type="text" id="role"  class="form-control input-small" value="' + aData[4] + '">';
            jqTds[4].innerHTML = '<select  id="role" class="form-control"><option>Super admin</option><option>Manager</option></select>';
            jqTds[5].innerHTML = '<a class="edit" onclick="edit_user()">Save</a> <a class="cancel" href="">Cancel</a>';
         
         
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a><a class="delete" href="">Delete</a>', nRow, 5, false);
            oTable.fnDraw();
        }

      
        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        var table = $('#sample_editable_1');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 5,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sample_editable_1_wrapper");

        var nEditing = null;
        var nNew = false;

        $('#sample_editable_1_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        
        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                // alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }
    var handleDashTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
       //ajax call to controller method to fetch process and category for edit option
        $.get( window.location.href+'/ajax-call', function(data) {
                 //     alert(data);
            var jsondata = JSON.parse(data);
                  for(i=0;i<jsondata.process.length;i++)
                  {
                    //   alert(jsondata.process[i].process_name);
                      $('#process').append('<option value="'+jsondata.process[i].process_name+'" >'+jsondata.process[i].process_name+'</option>');
                  }
                  for(i=0;i<jsondata.category.length;i++)
                  {
                    //   alert(jsondata.category[i].category_name);
                      $('#category').append('<option value="'+jsondata.category[i].category_name+'" >'+jsondata.category[i].category_name+'</option>');
                  }
                
          });
    
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            // jqTds[0].innerHTML = '<input type="text" id="unique" class="form-control input-small" value="' + aData[0] +'">';
            jqTds[1].innerHTML = '<input type="text" id="unique" class="form-control input-small" value="' + aData[1] +'" disabled>';
            jqTds[2].innerHTML = '<input type="text" id="expense" class="form-control input-small" value="'+ aData[2] +'">';
            jqTds[3].innerHTML = '<input type="text" id="user" class="form-control input-small" value="' + aData[3] +'">';
            jqTds[4].innerHTML = '<input type="hidden" id="item" class="form-control input-small" value="">';
            jqTds[5].innerHTML = '<input type="hidden" id="price" class="form-control input-small" value="">';
            jqTds[6].innerHTML = '<select id="process" class="form-control"><option value="' + aData[6] +'">' + aData[6] +'</option></select>';
            jqTds[7].innerHTML = '<select id="category" class="form-control"><option  value="'+aData[7]+'">'+aData[7]+'</option></select>';
            jqTds[8].innerHTML = '<select id="currency"  class="form-control"><option value="' + aData[8] + '" hidden>'+aData[8]+'</option><option value="£">£</option><option value="$">$</option> <option value="₹">₹</option></select>';
            jqTds[9].innerHTML = '<input type="text" id="amount"  class="form-control input-small" value="' + aData[9] + '">';
            jqTds[10].innerHTML = '<input type="file" id="img"  name="UploadedImage[]" class="form-control" multiple>';
            jqTds[11].innerHTML = '<input type="text" id="date" class="form-control input-medium" value="' + aData[11] +'" disabled>';
            jqTds[12].innerHTML = '<a class="edit" onclick="edit_expense()">Save</a> <a class="cancel" href="">Cancel</a>';
         
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            var jqSelects=$('select',nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqSelects[3].value, nRow, 3, false);
            oTable.fnUpdate(jqSelects[4].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
            oTable.fnUpdate(jqInputs[7].value, nRow, 7, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a><a class="delete" href="">Delete</a>', nRow, 8, false);
            oTable.fnDraw();
        }

      
        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
            oTable.fnUpdate(jqInputs[7].value, nRow, 7, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a><a class="delete" href="">Delete</a>', nRow, 8, false);
            oTable.fnDraw();
        }

        var table = $('#dashboard_editable');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],


            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 5,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            buttons: [
                { extend: 'print', className: 'btn dark btn-outline',//code export option pdf ,csv etc
                exportOptions:{
                    columns:[1,2,3,4,5,6,7,8]
                } 
             },
                { extend: 'copy', className: 'btn red btn-outline',
                exportOptions:{
                    columns:[1,2,3,4,5,6,7,8]
                } 
             },
                { extend: 'pdf', className: 'btn green btn-outline',
                exportOptions:{
                    columns:[1,2,3,4,5,6,7,8]
                } 
              },
                { extend: 'excel', className: 'btn yellow btn-outline ',
                exportOptions:{
                    columns:[1,2,3,4,5,6,7,8]
                } 
               },
                { extend: 'csv', className: 'btn purple btn-outline ',
                 exportOptions:{
                     columns:[1,2,3,4,5,6,7,8]
                 } 
                },
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
            ],
            "order": [
                [0, "asc"]
            ]// set first column as a default sort by asc
            
          
          
        });

        // var tableWrapper = $("#sample_editable_1_wrapper");

        var nEditing = null;
        var nNew = false;

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
            alert("Deleted! Do not forget to do some ajax to sync with backend :)");
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                // alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });

        $('#sample_3_tools > li > a.tool-action').on('click', function() {
            var action = $(this).attr('data-action');
            oTable.DataTable().button(action).trigger();
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
            handleDashTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});