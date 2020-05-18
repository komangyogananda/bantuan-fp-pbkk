{% extends 'layouts/layout.volt' %}
{% block body %}

<div class="container-fluid">
  <div class="row">
    <h1>Tambah bantuan</h1>
  </div>
</div>
<div class="container-fluid mt-3">
  <div class="row">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Item</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Category</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody id="table_body">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-lg-6">
      <button type="button" data-toggle="modal" data-target="#itemModal" id="tambah_item" class="btn btn-primary">Tambah item</button>
      <button type="submit" id="submit" class="btn btn-success">Submit</button>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-6">
            <img src={{ static_url('img/check-circle-solid.svg')}} />
          </div>
        </div> 
        <div class="row justify-content-center my-3">
          <h2>Success</h2>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="okayButton" data-dismiss="modal">Okay</button>
      </div>
    </div>
  </div>
</div>

<!-- item modal -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="item_form">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="nama">Nama Bantuan</span>
            </div>
            <input type="text" id="nama" class="form-control" aria-label="nama" aria-describedby="nama">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="category">Kategori</label>
            </div>
            <select class="custom-select" id="category">
              {% for category in categories %}
                <option value={{ category.getId() }}>{{ category.getNama() }}</option>
              {% endfor %}
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="jumlah">Jumlah</span>
            </div>
            <input type="text" id="jumlah" class="form-control" aria-label="jumlah" aria-describedby="jumlah">
          </div>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button id="tambah_modal" type="button" data-dismiss="modal" class="btn btn-primary">Tambah</button>
      </div>
    </div>
  </div>
</div>
{% endblock %}
{% block javascript %}
  <script>
    var items = [];
    $("#okayButton").on('click', function(event){
      window.location.replace("/bantuan/saya");
    })
    $('#tambah_item').on('click', function(event) {
      $("#item_form").trigger('reset');
    });

    $("#tambah_modal").on('click', function(event){
      var item = {
         'nama': $("input#nama").val(),
         'category_id': $("select#category").val(),
         'category': $("select#category").prop("options")[$("select#category").prop("selectedIndex")].text,
         'jumlah': $("input#jumlah").val()
       };
      items.push(item);
      var item_table = "<tr>"
      item_table += "<td>"+ item.nama +"</td>"
      item_table += "<td>"+ item.category +"</td>"
      item_table += "<td>"+ item.jumlah +"</td>"
      $('#table_body').append(item_table)
      console.log(items);
    });

    $("#submit").on('click', function(event){
      if (items.length == 0){
        alert('Item kosong');
      }else{
        $.ajax({
          url: '/bantuan/tambah',
          type: 'post',
          dataType: 'json',
          contentType: 'application/json',
          success: function(data){
            console.log("success")
            $("#successModal").modal('show')
          },
          data: JSON.stringify(items)
        })
      }
    });
  </script>
{% endblock %}