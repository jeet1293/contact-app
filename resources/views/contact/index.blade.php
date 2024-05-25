<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Contact List <span class="text-muted fw-normal ms-2">({{ $count }})</span></h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                
                    <div>
                        <a href="{{ route('contact.create') }}"class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add New
                        </a>
                    </div>
                    {{-- <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary">Manage Tags</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class>
                    <div class="table-responsive">
                        <table id="contactListTable" class="table project-list-table table-nowrap align-middle table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4" style="width: 50px;">
                                        <div class="form-check font-size-16"><input type="checkbox"
                                                class="form-check-input" id="contacusercheck" /><label
                                                class="form-check-label" for="contacusercheck"></label></div>
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Tags</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var table = $('#contactListTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contact.index') }}",
                columns: [
                    {data: 'checkbox', name: 'checkbox', sortable: false},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'tags', name: 'tags'},
                ],
                order: []
            });
            });
    </script>
</body>

</html>
