{% extends 'layouts/layout.volt' %}
{% block body %}
<div class="container-fluid">
  <div class="row">
    <h1>Bantuan Saya</h1>
  </div>
</div>

<div class="container-fluid mt-3">
  <div class="row">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="row">
          <div class="col-6">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Bantuan</h6>
          </div>
          <div class="col-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="category">Kategori</label>
              </div>
              <select class="custom-select" id="category">
                <option
                 {% if selected_category == -1 %}
                    selected
                 {% endif %}
                 value="-1">Semua</option>
                {% for category in categories %}
                  <option 
                    {% if selected_category == category.getId() %}
                      selected
                    {% endif %}
                  value={{ category.getId() }}>{{ category.getNama() }}</option>
                {% endfor %}
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Jumlah item</th>
                <th>Tanggal</th>
                <th>Items</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Jumlah item</th>
                <th>Tanggal</th>
                <th>Items</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
{% endblock %}
{% block javascript %}
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function(){
    
    $("#category").on("change", function (){
      if (this.value == 0){
        window.location.href = "/bantuan/saya"
      }else{
        window.location.href = "/bantuan/saya?category=" + this.value;
      }
    })

    function format(d){
      var html = '<table class="table table-borderless">'+
      '<thead>'+
        '<tr>'+
        '<th>Nomor</th>'+
        '<th>Nama</th>'+
        '<th>Kategori</th>'+
        '<th>Jumlah</th>'+
        '</tr>'+
      '</thead>'+
      '<tbody>'
      console.log(d);
      var idx = 1;
      d.items.forEach(function (item){
        var row = '<tr>'+
          '<th>'+ idx++ +'</th>'+
          '<th>'+ item.nama +'</th>'+
          '<th>'+ item.category +'</th>'+
          '<th>'+ item.jumlah +'</th>'+
        '</tr>';
        html += row;
      })
      html += '</tbody>'
      return html;
    }

    var url = $("#category").val() == -1 ? '/bantuan/saya' : window.location.href 

    var dataTable = $("#dataTable").DataTable({
      "ajax": {
        "url": url,
        "dataSrc": function(json){
          console.log(json);
          return json
        }
      },
      searching: false,
      lengthMenu: [5, 10],
      columns: [
        {"data": "itemsLength"},
        {"data": "createdAt"},
        {
          "className":      'details-control',
          "orderable":      false,
          "data":           null,
          "defaultContent": '<i class="fas fa-caret-down"></i>'
        }
      ],
      order: [[1, 'desc']]
    })

    $('#dataTable').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dataTable.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
  })
</script>
{% endblock %}