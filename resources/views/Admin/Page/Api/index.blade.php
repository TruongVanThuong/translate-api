@extends('Admin.Share.master')
@section('title')
API
@endsection
@section('noi_dung')

<style>
    #table_id th, #table_id td {
      padding: 17px;
      font-size: 14px;
    }
    #table_id td:nth-child(1) {
      max-width: 5% !important;
      overflow: hidden;
      white-space: normal;
      text-overflow: ellipsis;
    }
    #table_id td:nth-child(2) {
      max-width: 70% !important;
      overflow: hidden;
      white-space: normal;
      text-overflow: ellipsis;
    }
    #table_id td:nth-child(3) {
      max-width: 10% !important;
      overflow: hidden;
      white-space: normal;
      text-overflow: ellipsis;
    }
    #table_id td:nth-child(4) {
      max-width: 15% !important;
      overflow: hidden;
      white-space: normal;
      text-overflow: ellipsis;
    }
  </style>

<div class="row" id="app" v-cloak>

  <div class="col-md-12 mb-3">
    <div class="modal-category">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm API
      </button>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-center">
        <h3> Danh Sách API</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table_id" class="table table-bordered">
            <thead clas="bg-primary">
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">API</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="(data_api, key) in data_api">
                  <td class="align-middle text-center">@{{key + 1}}</td>
                  <td class="align-middle text-center">@{{ data_api.api }}</td>
                  <td class="align-middle text-center">@{{ data_api.status }}</td>
                  <td class="align-middle text-center">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteAPI"
                    v-on:click="xoa_api = data_api" >Xóa</button>
                  </td>
                </tr>
              </tbody>
              <!-- MODAL DELETE -->
              <div class="modal fade" id="DeleteAPI" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDeleteAPI" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalDeleteAPI">Xác Nhận Xoá Dữ Liệu</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Bạn có chắc muốn xoá dữ liệu này không?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                      v-on:click="delete_api()">Xoá</button>
                    </div>
                  </div>
                </div>
              </div>
            <!-- Modal them API-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm API</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form id="categoryForm">
                    <div class="modal-body">
                      <div class="form-group mt-3">
                        <label>Nhập vào API</label>
                        <input type="text" v-model="addAPI.api" class="form-control" placeholder="Nhập vào API">

                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                      <button type="button" class="btn btn-primary" v-on:click="add_api()">Thêm API</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal cap nhat tai khoan-->



          </table>
        </div>
        <div></div>
      </div>
    </div>
  </div>


</div>

@endsection
@section('js')

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function () {
  $('#table_id').DataTable();
});

new Vue({
  el: '#app',

  data: {
    addAPI: {},
    data_api: [],
    xoa_api: {},
    errors: [],
  },

  created() {
    this.GetData();
  },

  methods: {

    GetData() {
      axios
      .get('/admin/api/get-api')
      .then((res) => {
        this.data_api = res.data.data_api;
      })
    },

    add_api() {
      axios
      .post('/admin/api/add-api',this.addAPI)
      .then((res) => {
        if (res.data.status) {
          toastr.success(res.data.message);
          this.GetData();
          // Tắt modal xác nhận
          $('#exampleModal').modal('hide');
        } else {
          toastr.error('Có lỗi không mong muốn! 1');
        }
      })
      .catch((error) => {

      })
    },

    delete_api() {
      axios
      .post('/admin/api/delete-api', this.xoa_api)
      .then((res) => {
        if (res.data.status) {
          toastr.success(res.data.message);
          this.GetData();
        } else {
          toastr.error('Có lỗi không mong muốn!');
        }
      })
    }

  },
});
</script>


@endsection
