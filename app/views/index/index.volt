{% extends 'layouts/layout.volt' %}
{% block body %}
<div class="container-fluid">
  <div class="row">
    <h1>Bantuan terkumpul</h1>
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
                <th>Nomor</th>
                <th>User</th>
                <th>Jumlah item</th>
                <th>Tanggal</th>
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
{% endblock %}